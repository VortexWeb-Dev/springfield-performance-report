<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div class="w-[85%] bg-gray-100 dark:bg-gray-900 relative">
    <?php include('includes/navbar.php'); ?>

    <!-- Loading Spinner -->
    <div id="loadingSpinner" class="absolute inset-0 flex items-center justify-center">
        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500"></div>
    </div>

    <div class="max-w-5xl mx-auto px-6 py-8 pt-0" id="formContainer" style="display: none;">
        <h1 class="text-3xl font-bold text-center text-gray-800 dark:text-white">
            <span class="month"></span> <span class="year"></span> Performance Evaluation
        </h1>
        <p class="text-lg font-semibold text-center text-gray-600 dark:text-gray-400 mb-8 ">
            <span class="username"></span>
        </p>

        <!-- Form Begins -->
        <form class="space-y-8 bg-white dark:bg-gray-800 rounded-lg p-8 shadow-md">
            <!-- Marketing Leads -->
            <div>
                <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-300">No. of Marketing Leads Received (Including repeat inquiries)</label>
                <input disabled type="number" class="form-input dark:bg-gray-700 dark:text-gray-100 w-full" name="marketingLeads">
            </div>

            <div>
                <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-300">Active Leads</label>
                <input disabled type="number" class="form-input dark:bg-gray-700 dark:text-gray-100 w-full" name="activeLeads">
            </div>

            <div>
                <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-300">Unqualified/Reassigned Leads</label>
                <input disabled type="number" class="form-input dark:bg-gray-700 dark:text-gray-100 w-full" name="unqualifiedLeads">
            </div>

            <!-- Hubspot Lead Update Statistics -->
            <div class="bg-yellow-50 dark:bg-yellow-900 p-6 rounded-lg">
                <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-100">Hubspot Lead Update Statistics (as of <span class="month"></span> <span class="year"></span>)</h3>

                <div class="mb-4">
                    <label class="block font-semibold text-gray-700 dark:text-gray-300">Leads without Update for more than 2 weeks</label>
                    <input disabled type="text" class="form-input dark:bg-gray-700 dark:text-gray-100 w-full" name="leadsWithoutUpdate">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold text-gray-700 dark:text-gray-300">New Deals Created in Hubspot (<span class="month"></span> <span class="year"></span>)</label>
                    <input disabled type="text" class="form-input dark:bg-gray-700 dark:text-gray-100 w-full" name="newHubspotDeals">
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 dark:text-gray-300">No. of Meetings Conducted in Hubspot (<span class="month"></span> <span class="year"></span>)</label>
                    <input disabled type="text" class="form-input dark:bg-gray-700 dark:text-gray-100 w-full" name="newHubspotMeetings">
                </div>
            </div>

            <!-- PropertyFinder Ads and Leads -->
            <div>
                <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-100">PropertyFinder Ads and Leads (as of <span class="month"></span> <span class="year"></span>)</h3>

                <div class="mb-4">
                    <label class="block font-semibold text-gray-700 dark:text-gray-300">No. Live Ads</label>
                    <input disabled type="number" class="form-input dark:bg-gray-700 dark:text-gray-100 w-full" name="propertyFinderAds">
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 dark:text-gray-300">No. of Leads Received from PropertyFinder Ads</label>
                    <input disabled type="number" class="form-input dark:bg-gray-700 dark:text-gray-100 w-full" name="propertyFinderLeads">
                </div>
            </div>

            <!-- Deals Table -->
            <div>
                <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-100">Deals in <span class="year"></span></h3>

                <table class="w-full border-collapse bg-white dark:bg-gray-700 shadow-md rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300">
                            <th class="p-4 text-left">Unit Details</th>
                            <th class="p-4 text-left">Property Price</th>
                            <th class="p-4 text-left">Type</th>
                            <th class="p-4 text-left">Net Commission</th>
                            <th class="p-4 text-left">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t dark:border-gray-500">
                            <td class="p-4">B101Z-F34-3414</td>
                            <td class="p-4">AED 2,019,000.00</td>
                            <td class="p-4">Sale</td>
                            <td class="p-4">AED 50,475.00</td>
                            <td class="p-4">29-Feb</td>
                        </tr>
                        <tr class="border-t dark:border-gray-500">
                            <td class="p-4">Silicon Gates 4</td>
                            <td class="p-4">AED 512,000.00</td>
                            <td class="p-4">Sale</td>
                            <td class="p-4">AED 2,560.00</td>
                            <td class="p-4">12-Mar</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Summary Information -->
            <div class="mt-6">
                <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-300">Total Earnings Year to Date</label>
                <input disabled type="text" class="form-input dark:bg-gray-700 dark:text-gray-100 w-full" value="AED 103,890.00" name="totalEarnings">
            </div>

            <div>
                <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-300">Total Worth of Properties Sold Year to Date</label>
                <input disabled type="text" class="form-input dark:bg-gray-700 dark:text-gray-100 w-full" name="totalWorthOfProperties">
            </div>

            <div>
                <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-300">Average Monthly Earnings</label>
                <input disabled type="text" class="form-input dark:bg-gray-700 dark:text-gray-100 w-full" name="avgMonthlyEarnings">
            </div>

            <!-- Ranking Information -->
            <div class="mt-6">
                <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-300">Rank for <span class="month"></span> <span class="year"></span></label>
                <input disabled type="text" class="form-input dark:bg-gray-700 dark:text-gray-100 w-full" name="ranking">
            </div>

            <div>
                <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-300">YTD Ranking</label>
                <input disabled type="text" class="form-input dark:bg-gray-700 dark:text-gray-100 w-full" name="ytdRanking">
            </div>
        </form>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const loadingSpinner = document.getElementById("loadingSpinner");
        const formContainer = document.getElementById("formContainer");

        // Show spinner initially
        loadingSpinner.style.display = 'flex';
        formContainer.style.display = 'none';

        fetch('./data/fetch_performance_report.php')
            .then(response => response.json())
            .then(data => {
                console.log(data);

                // Populate form fields with fetched data
                document.querySelector("input[name='marketingLeads']").value = data.marketingLeads;
                document.querySelector("input[name='activeLeads']").value = data.activeLeads;
                document.querySelector("input[name='unqualifiedLeads']").value = data.unQualifiedLeads;

                document.querySelector("input[name='leadsWithoutUpdate']").value = data.leadsWithoutUpdate + " leads no update for 2 weeks";
                document.querySelector("input[name='newHubspotDeals']").value = data.newHubspotDeals || "No deals";
                document.querySelector("input[name='newHubspotMeetings']").value = data.newHubspotMeetings || "No meetings";

                document.querySelector("input[name='propertyFinderAds']").value = data.propertyFinderAds;
                document.querySelector("input[name='propertyFinderLeads']").value = data.propertyFinderLeads;

                document.querySelector("input[name='totalEarnings']").value = data.totalEarnings;
                document.querySelector("input[name='totalWorthOfProperties']").value = data.totalWorthOfProperties;
                document.querySelector("input[name='avgMonthlyEarnings']").value = data.avgMonthlyEarnings;

                document.querySelector("input[name='ranking']").value = data.rankForMonth;
                document.querySelector("input[name='ytdRanking']").value = data.ytdRanking;

                document.querySelector("span.username").innerHTML  = data.user.NAME;

                document.querySelectorAll(".month").forEach(element => {
                    element.innerHTML = data.currentMonth
                })
                document.querySelectorAll(".year").forEach(element => {
                    element.innerHTML = data.currentYear
                })

                // Hide the spinner and show the form once data is loaded
                loadingSpinner.style.display = 'none';
                formContainer.style.display = 'block';
            })
            .catch(error => {
                console.error("Error fetching data:", error);

                // Hide spinner if there's an error
                loadingSpinner.style.display = 'none';
                formContainer.style.display = 'block';
            });
    });
</script>


<?php include('includes/footer.php'); ?>