<?php
include_once '../crest/crest.php';
include_once '../crest/settings.php';

CRest::call(
    'event.bind',
    [
        'event' => 'onCrmDealAdd',
        'handler' => 'https://lightgray-kudu-834713.hostingersite.com/springfield-agent-rankings/handlers/update_agent_ranking.php',
    ]
);
CRest::call(
    'event.bind',
    [
        'event' => 'onCrmDealUpdate',
        'handler' => 'https://lightgray-kudu-834713.hostingersite.com/springfield-agent-rankings/handlers/update_agent_ranking.php',
    ]
);
CRest::call(
    'event.bind',
    [
        'event' => 'onCrmDealDelete',
        'handler' => 'https://lightgray-kudu-834713.hostingersite.com/springfield-agent-rankings/handlers/update_agent_ranking.php',
    ]
);
CRest::call(
    'event.bind',
    [
        'event' => 'onCrmDealUserFieldUpdate',
        'handler' => 'https://lightgray-kudu-834713.hostingersite.com/springfield-agent-rankings/handlers/update_agent_ranking.php',
    ]
);
