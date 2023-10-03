<div class="form-group row align-items-center" :class="{'has-danger': errors.has('caller_phonenumber'), 'has-success': this.fields.caller_phonenumber && this.fields.caller_phonenumber.valid }">
    <label for="caller_phonenumber" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.call-log.columns.caller_phonenumber') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.caller_phonenumber" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('caller_phonenumber'), 'form-control-success': this.fields.caller_phonenumber && this.fields.caller_phonenumber.valid}" id="caller_phonenumber" name="caller_phonenumber" placeholder="{{ trans('admin.call-log.columns.caller_phonenumber') }}">
        <div v-if="errors.has('caller_phonenumber')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('caller_phonenumber') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('callee_phonenumber'), 'has-success': this.fields.callee_phonenumber && this.fields.callee_phonenumber.valid }">
    <label for="callee_phonenumber" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.call-log.columns.callee_phonenumber') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.callee_phonenumber" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('callee_phonenumber'), 'form-control-success': this.fields.callee_phonenumber && this.fields.callee_phonenumber.valid}" id="callee_phonenumber" name="callee_phonenumber" placeholder="{{ trans('admin.call-log.columns.callee_phonenumber') }}">
        <div v-if="errors.has('callee_phonenumber')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('callee_phonenumber') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('call_id'), 'has-success': this.fields.call_id && this.fields.call_id.valid }">
    <label for="call_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.call-log.columns.call_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.call_id" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('call_id'), 'form-control-success': this.fields.call_id && this.fields.call_id.valid}" id="call_id" name="call_id" placeholder="{{ trans('admin.call-log.columns.call_id') }}">
        <div v-if="errors.has('call_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('call_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('user_id'), 'has-success': this.fields.user_id && this.fields.user_id.valid }">
    <label for="user_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.call-log.columns.user_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.user_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('user_id'), 'form-control-success': this.fields.user_id && this.fields.user_id.valid}" id="user_id" name="user_id" placeholder="{{ trans('admin.call-log.columns.user_id') }}">
        <div v-if="errors.has('user_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('user_id') }}</div>
    </div>
</div>


