<?php
include_once "../crest/crest.php";
include_once "../crest/settings.php";
include_once "../data/fetch_deals.php";
include_once "../data/fetch_users.php";
include_once "../utils/index.php";

function calculateAgentRank($agent_id)
{
    $cache_file = 'cache/global_ranking_cache.json';
    $global_ranking = [];

    if (file_exists($cache_file)) {
        $global_ranking = json_decode(file_get_contents($cache_file), true);
    } else {
        $global_ranking = [
            2024 => [
                'monthwise_rank' => [
                    'Jan' => [],
                    'Feb' => [],
                    'Mar' => [],
                    'Apr' => [],
                    'May' => [],
                    'Jun' => [],
                    'Jul' => [],
                    'Aug' => [],
                    'Sep' => [],
                    'Oct' => [],
                    'Nov' => [],
                    'Dec' => [],
                ],
                'yearly_rank' => []
            ]
        ];

        $deal_filters = ['ASSIGNED_BY_ID' => $agent_id];
        $deal_selects = ['BEGINDATE', 'ASSIGNED_BY_ID', 'UF_CRM_1727871887978'];
        $deal_orders = ['UF_CRM_1727871887978' => 'DESC', 'BEGINDATE' => 'DESC'];

        $sorted_deals = get_filtered_deals($deal_filters, $deal_selects, $deal_orders);

        store_agents($sorted_deals, $global_ranking);
        store_remaining_agents([getCurrentUser()], $global_ranking);

        assign_monthly_rank($global_ranking);
        assign_yearly_rank($global_ranking);

        if (!is_dir('cache')) {
            mkdir('cache', 0777, true);
        }
        file_put_contents($cache_file, json_encode($global_ranking));
    }

    $current_year = date('Y');
    $current_month = date('M');

    $agent_rank = [
        'monthly_rank' => null,
        'yearly_rank' => null
    ];

    if (isset($global_ranking[$current_year]['monthwise_rank'][$current_month][$agent_id])) {
        $agent_rank['monthly_rank'] = $global_ranking[$current_year]['monthwise_rank'][$current_month][$agent_id];
    }

    if (isset($global_ranking[$current_year]['yearly_rank'][$agent_id])) {
        $agent_rank['yearly_rank'] = $global_ranking[$current_year]['yearly_rank'][$agent_id];
    }

    return $agent_rank;
}
