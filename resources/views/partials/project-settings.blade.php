<spark-settings-subscription-screen inline-template>
    <div id="spark-settings-subscription-screen">
        <div v-if="userIsLoaded && plansAreLoaded">

           

            <!-- Update Credit Card -->
            @include('spark::settings.tabs.subscription.card')

            @include('spark::settings.tabs.subscription.invoices.vat')

          
        </div>
    </div>
</spark-settings-subscription-screen>
