@if (Auth::user()->isDeveloper())
<div>
    <button v-if="todo.status == '{{ \CMV\Models\PM\ToDo::STATUS_NEW }}'"
            v-on:click.stop="setStatus(todo, '{{ \CMV\Models\PM\ToDo::STATUS_IN_WORK }}')"
            class="btn {{$btnClass}} btn-default-outline">Start Task</button>

    <button v-if="todo.status == '{{ \CMV\Models\PM\ToDo::STATUS_IN_WORK }}'"
            v-on:click.stop="setStatus(todo, '{{ \CMV\Models\PM\ToDo::STATUS_FINISHED }}')"
            class="btn {{$btnClass}} btn-primary">Finish Task</button>

    <button v-if="todo.status == '{{ \CMV\Models\PM\ToDo::STATUS_FINISHED }}'"
            v-on:click.stop="setStatus(todo, '{{ \CMV\Models\PM\ToDo::STATUS_DELIVERED }}')"
            class="btn {{$btnClass}} btn-primary">Deliver Task</button>

    <button v-if="todo.status == '{{ \CMV\Models\PM\ToDo::STATUS_DELIVERED }}'"
            v-on:click.stop="setStatus(todo, '{{ \CMV\Models\PM\ToDo::STATUS_IN_WORK }}')"
            class="btn {{$btnClass}} btn-warning">Undo Delivery</button>

    <button v-if="todo.status == '{{ \CMV\Models\PM\ToDo::STATUS_REJECTED }}'"
            v-on:click.stop="setStatus(todo, '{{ \CMV\Models\PM\ToDo::STATUS_IN_WORK }}')"
            class="btn {{$btnClass}} btn-warning">Restart</button>

</div>
@else
<div>
    <button v-if="todo.status == '{{ \CMV\Models\PM\ToDo::STATUS_NEW }}'"
            class="btn {{$btnClass}} btn-default-outline" disabled>Unstarted</button>

    <button v-if="todo.status == '{{ \CMV\Models\PM\ToDo::STATUS_IN_WORK }}' || todo.status == '{{ \CMV\Models\PM\ToDo::STATUS_FINISHED }}'"
            class="btn {{$btnClass}} btn-default-outline" disabled>In Progress</button>

    <button v-if="todo.status == '{{ \CMV\Models\PM\ToDo::STATUS_DELIVERED }}'"
            v-on:click.stop="setStatus(todo, '{{ \CMV\Models\PM\ToDo::STATUS_ACCEPTED }}')"
            class="btn {{$btnClass}} btn-success">Accept</button>

    <button v-if="todo.status == '{{ \CMV\Models\PM\ToDo::STATUS_DELIVERED }}'"
            v-on:click.stop="setStatus(todo, '{{ \CMV\Models\PM\ToDo::STATUS_REJECTED }}')"
            class="btn {{$btnClass}} btn-danger">Reject</button>

    <button v-if="todo.status == '{{ \CMV\Models\PM\ToDo::STATUS_REJECTED }}'"
            class="btn {{$btnClass}} btn-default-outline" disabled>Rejected</button>
</div>
@endif