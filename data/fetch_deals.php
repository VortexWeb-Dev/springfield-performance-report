<?php
require_once __DIR__ . '/../crest/crest.php';


function get_all_deals()
{
    $result = CRest::call('crm.deal.list', [
        'select' => ['*', 'UF_*'],
        'filter' => ['CATEGORY_ID' => 0],
    ]);
    $deals = $result['result'];
    return $deals;
}


function get_deal_fileds()
{

    $result = CRest::call('crm.deal.fields', [
        'select' => ['*', 'UF_*'],
        // 'filter' => [
        //     'CATEGORY_ID' => 0
        // ]
    ]);
    $fields = $result['result'];
    return $fields;
}

function get_filtered_deals($filter = [], $select = [], $order = [])
{
    $result = CRest::call('crm.deal.list', [
        'select' => $select ?? ['*', 'UF_*'],
        'filter' => $filter,
        'order' => $order,
    ]);
    $deals = $result['result'];
    return $deals;
}
