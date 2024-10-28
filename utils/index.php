<?php

// Add resuable utility functions here

// calculate duration in months
function duration_months($date)
{
    $date1 = new DateTime($date);
    $date2 = new DateTime();
    $interval = $date1->diff($date2);
    return $interval->m + ($interval->y * 12);
}

// map enum with the values
function map_enum($fields, $field_id, $key_to_map)
{
    foreach ($fields as $field) {
        if (isset($field['title']) && $field['title'] == $field_id) {
            foreach ($field['items'] as $item) {
                if ($item['ID'] == $key_to_map) {
                    return $item['VALUE'];
                }
            }
        }
    }
}

function get_quarter($month)
{
    if ($month == 'Jan' || $month == 'Feb' || $month == 'Mar') {
        return 'Q1';
    } elseif ($month == 'Apr' || $month == 'May' || $month == 'Jun') {
        return 'Q2';
    } elseif ($month == 'Jul' || $month == 'Aug' || $month == 'Sep') {
        return 'Q3';
    } elseif ($month == 'Oct' || $month == 'Nov' || $month == 'Dec') {
        return 'Q4';
    }
}

function clearCache($fileName)
{
    $filePath = 'cache/' . $fileName;
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

function store_agents($sorted_deals, &$global_ranking)
{
    foreach ($sorted_deals as $deal) {
        $responsible_agent_id = $deal['ASSIGNED_BY_ID'];

        if (true) {
            $year = date('Y', strtotime($deal['BEGINDATE']));
            $month = date('M', strtotime($deal['BEGINDATE']));

            $gross_comms = isset($deal['UF_CRM_1727871887978']) ? (int)explode('|', $deal['UF_CRM_1727871887978'])[0] : 0;

            $agent = getUser($responsible_agent_id);
            $agent_full_name = $agent['NAME'] ?? '' . $agent['SECOND_NAME'] ?? '' . ' ' . $agent['LAST_NAME'] ?? '';

            $global_ranking[$year]['monthwise_rank'][$month][$responsible_agent_id]['name'] = $agent_full_name ?? null;

            if (!isset($global_ranking[$year]['monthwise_rank'][$month][$responsible_agent_id]['gross_comms'])) {
                $global_ranking[$year]['monthwise_rank'][$month][$responsible_agent_id]['gross_comms'] = $gross_comms;
            } else {
                $global_ranking[$year]['monthwise_rank'][$month][$responsible_agent_id]['gross_comms'] += $gross_comms;
            }

            if (!isset($global_ranking[$year]['yearly_rank'][$responsible_agent_id]['name'])) {
                $global_ranking[$year]['yearly_rank'][$responsible_agent_id]['name'] = $agent_full_name ?? null;
            }

            if (!isset($global_ranking[$year]['yearly_rank'][$responsible_agent_id]['gross_comms'])) {
                $global_ranking[$year]['yearly_rank'][$responsible_agent_id]['gross_comms'] = $gross_comms;
            } else {
                $global_ranking[$year]['yearly_rank'][$responsible_agent_id]['gross_comms'] += $gross_comms;
            }
        }
    }
}

function store_remaining_agents($agents, &$global_ranking)
{
    foreach ($global_ranking as $year => $months) {
        foreach ($months as $rank_type => $rank_data) {
            if ($rank_type == 'monthwise_rank') {
                foreach ($rank_data as $month => $agents_data) {
                    foreach ($agents as $id => $agent) {
                        $agent_id = $id ?? 0;
                        if (!isset($global_ranking[$year][$rank_type][$month][$agent_id])) {
                            $agent_full_name = $agent['NAME'] ?? '';
                            $global_ranking[$year][$rank_type][$month][$agent_id]['name'] = $agent_full_name ?? null;
                            $global_ranking[$year][$rank_type][$month][$agent_id]['gross_comms'] = 0;
                        }
                    }
                }
            } else if ($rank_type == 'yearly_rank') {
                foreach ($agents as $id => $agent) {
                    $agent_id = $id ?? 0;
                    if (!isset($global_ranking[$year][$rank_type][$agent_id])) {
                        $agent_full_name = $agent['NAME'] ?? '';
                        $global_ranking[$year][$rank_type][$agent_id]['name'] = $agent_full_name ?? null;
                        $global_ranking[$year][$rank_type][$agent_id]['gross_comms'] = 0;
                    }
                }
            }
        }
    }
}

function assign_monthly_rank(&$global_ranking)
{
    foreach ($global_ranking as $year => &$months) {
        foreach ($months['monthwise_rank'] as $month => &$agents) {
            uasort($agents, function ($a, $b) {
                return $b['gross_comms'] <=> $a['gross_comms'];
            });

            $rank = 1;
            $previous_gross_comms = null;
            foreach ($agents as &$agent) {
                if ($previous_gross_comms !== null && $agent['gross_comms'] == $previous_gross_comms) {
                    $agent['rank'] = $rank;
                } else {
                    $agent['rank'] = $rank;
                    $previous_gross_comms = $agent['gross_comms'];
                    $rank++;
                }
            }
        }
    }
}

function assign_yearly_rank(&$global_ranking)
{
    foreach ($global_ranking as $year => &$data) {
        if (isset($data['yearly_rank'])) {
            uasort($data['yearly_rank'], function ($a, $b) {
                return $b['gross_comms'] <=> $a['gross_comms'];
            });

            $rank = 1;
            $previous_gross_comms = null;
            foreach ($data['yearly_rank'] as &$agent) {
                if ($previous_gross_comms !== null && $agent['gross_comms'] == $previous_gross_comms) {
                    $agent['rank'] = $rank;
                } else {
                    $agent['rank'] = $rank;
                    $previous_gross_comms = $agent['gross_comms'];
                    $rank++;
                }
            }
        }
    }
}
