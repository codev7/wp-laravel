<div class="modal fade" id="modal-change-plan" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="fa fa-btn fa-random"></i>Change Plan</h4>
			</div>

			<div class="modal-body">
				<spark-errors :form="changePlanForm"></spark-errors>

				<!-- Plan Selector -->
				@include('spark::settings.tabs.subscription.modals.change.selector')
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

				<button type="button" class="btn btn-primary" @click.prevent="changePlan" :disabled="changePlanForm.busy">
					<span v-if="changePlanForm.busy">
						<i class="fa fa-btn fa-spinner fa-spin"></i>Changing
					</span>

					<span v-else>
						<i class="fa fa-btn fa-random"></i>Change Plan
					</span>
				</button>
			</div>
		</div>
	</div>
</div>
