<div class="panel panel-default">
	<div class="panel-heading">
		<div class="pull-left">
			Billing Information
		</div>

		<!-- If On Single Plan Application -> Show Price On Billing Heading -->
		<div class="pull-right">
			<span v-if="plans.length == 1">
				(@{{ selectedPlanPrice }} / @{{ selectedPlan.interval | capitalize }})
			</span>
		</div>

		<div class="clearfix"></div>
	</div>

	<div class="panel-body">
		<spark-error-alert :form="cardForm"></spark-error-alert>

		<form class="form-horizontal" role="form">
			<div class="form-group" :class="{'has-error': hasError(cardForm, 'number')}">
				<label for="number" class="col-sm-3 control-label">Card Number</label>

				<div class="col-sm-6">
					<input type="text" class="form-control" name="number" data-stripe="number" v-model="cardForm.number">

                    <span class="help-block" v-show="hasError(cardForm, 'number')">
                        <strong>@{{ getError(cardForm, 'number') }}</strong>
                    </span>
				</div>
			</div>

			<div class="form-group">
				<label for="number" class="col-sm-3 control-label">Security Code</label>

				<div class="col-sm-6">
					<input type="text" class="form-control" name="cvc" data-stripe="cvc" v-model="cardForm.cvc">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">Expiration</label>

				<div class="col-sm-3">
					<input type="text" class="form-control" name="month" placeholder="MM" maxlength="2" data-stripe="exp-month" v-model="cardForm.month">
				</div>

				<div class="col-sm-3">
					<input type="text" class="form-control" name="year" placeholder="YYYY" maxlength="4" data-stripe="exp-year" v-model="cardForm.year">
				</div>
			</div>

			<div class="form-group">
				<label for="number" class="col-sm-3 control-label">ZIP / Postal Code</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="zip" v-model="cardForm.zip">
				</div>
			</div>

			<div class="form-group" :class="{'has-error': hasError(registerForm, 'terms')}">
				<div class="col-sm-6 col-sm-offset-3">
					<div class="checkbox">
						<label>
							<input type="checkbox" v-model="registerForm.terms">
							I Accept The <a href="/terms" target="_blank">Terms Of Service</a>

		                    <span class="help-block" v-show="hasError(registerForm, 'terms')">
		                        <strong>@{{ getError(registerForm, 'terms') }}</strong>
		                    </span>
						</label>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-6 col-sm-offset-3">
					<button type="submit" class="btn btn-primary" @click.prevent="register" :disabled="registerForm.busy">
						<span v-if="registerForm.busy">
							<i class="fa fa-btn fa-spinner fa-spin"></i> Registering
						</span>

						<span v-else>
							<i class="fa fa-btn fa-check-circle"></i>

							<span v-if=" ! selectedPlan.trialDays">
								Register
							</span>

							<span v-else>
								Begin @{{ selectedPlan.trialDays }} Day Trial
							</span>
						</span>
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
