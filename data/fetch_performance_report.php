<?php
include('fetch_leads.php');
include('fetch_deals.php');
include('fetch_users.php');
include('../controllers/calculate_agent_rank.php');
require_once __DIR__ . '/../crest/crest.php';


$user = getCurrentUser();
$user_id = $user['ID'];

$current_month = date('F');
$current_year = date('Y');

$agent_rankings = calculateAgentRank($user_id);

$allLeads = getAllLeads();

$marketing_leads = 200;
$active_leads = CRest::call('crm.lead.list', ['filter' => ['ASSIGNED_BY_ID' => $user_id]])['total'];
$un_qualified_leads = CRest::call('crm.lead.list', ['filter' => ['ASSIGNED_BY_ID' => $user_id, 'STATUS_ID' => 'JUNK']])['total'];

$leads_without_update = 2;
$new_hubspot_deals = 0;
$new_hubspot_meetings = 0;

$propertyfinder_ads = 3;
$propertyfinder_leads = 5;

$all_deals = get_filtered_deals(['ASSIGNED_BY_ID' => $user_id]);
$total_earnings = 0;

foreach ($all_deals as $deal) {
    $total_earnings += $deal['OPPORTUNITY'];
}

$total_worth_of_properties =  6420000;
$avg_monthly_earnings = $total_earnings / 12;
$rank_for_month = $agent_rankings['monthly_rank']['rank'];
$ytd_ranking = $agent_rankings['yearly_rank']['rank'];

echo json_encode([
    'leads' => $allLeads,
    'totalLeads' => count($allLeads),
    'marketingLeads' => $marketing_leads,
    'activeLeads' => $active_leads,
    'unQualifiedLeads' => $un_qualified_leads,
    'leadsWithoutUpdate' => $leads_without_update,
    'newHubspotDeals' => $new_hubspot_deals,
    'newHubspotMeetings' => $new_hubspot_meetings,
    'propertyFinderAds' => $propertyfinder_ads,
    'propertyFinderLeads' => $propertyfinder_leads,
    'totalEarnings' => $total_earnings,
    'totalWorthOfProperties' => $total_worth_of_properties,
    'avgMonthlyEarnings' => $avg_monthly_earnings,
    'rankForMonth' => $rank_for_month,
    'ytdRanking' => $ytd_ranking,
    'currentMonth' => $current_month,
    'currentYear' => $current_year,
    'user' => $user
]);
