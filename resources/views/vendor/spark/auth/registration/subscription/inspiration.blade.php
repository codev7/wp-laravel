<!-- Plan Has Not Been Selected -->
<div v-if="plans.length > 1 && ! registerForm.plan">
	<div class="row spark-subscription-inspiration-single">
		Which concierge plan is for you?
        <br />
        <p class="text-center text-muted"><small style="font-size: 15px; line-height: 18px; margin-top: 15px; display: block;">Are you just looking for a project quote?  <a href="#">Get a Free Project Quote</a>.</small></p>
	</div>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">

        </div>
    </div><!--row-->
</div>

<!-- Plan Is Selected Or There Is Only A Single Plan -->
<div class="row spark-subscription-inspiration-single" v-if="registerForm.plan">
	Thanks for coming on board.
</div>
