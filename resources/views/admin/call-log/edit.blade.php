@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.call-log.actions.edit', ['name' => $callLog->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <call-log-form
                :action="'{{ $callLog->resource_url }}'"
                :data="{{ $callLog->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.call-log.actions.edit', ['name' => $callLog->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.call-log.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </call-log-form>

        </div>
    
</div>

@endsection