<div class="panel panel-default" v-if="user.stripe_active">
	<div class="panel-heading">Cancel Subscription</div>

	<div class="panel-body">
		<button class="btn btn-danger" @click.prevent="confirmSubscriptionCancellation">
			<i class="fa fa-btn fa-times"></i>Cancel Subscription
		</button>
	</div>
</div>
