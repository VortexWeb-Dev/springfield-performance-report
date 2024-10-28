<?php
require_once __DIR__ . '/../crest/crest.php';

function getLeads($start = null)
{
    $params = ['select' => ['*']];

    if ($start !== null) {
        $params['start'] = $start;
    }

    return CRest::call('crm.lead.list', $params);
}

function getLead($lead_id)
{
    $result = CRest::call('crm.lead.get', ['ID' => $lead_id]);
    $lead = $result['result'];

    return $lead;
}

function getAllLeads()
{
    $allLeads = [];
    $start = 0;

    do {
        $leadsData = getLeads($start);

        if (isset($leadsData['result'])) {
            $allLeads = array_merge($allLeads, $leadsData['result']);
        }

        $start = $leadsData['next'] ?? null;
    } while ($start !== null);

    return $allLeads;
}
