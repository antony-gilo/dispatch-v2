<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <form class="form-horizontal" wire:submit.prevent="dispatch">
        @csrf
        {{-- STEP 1 --}}
        @if ($currentStep == 1)
            <div class="form-section step-1">
                <div class="form-group">
                    <label class="col-md-2 control-label">Caller Full Names</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" wire:model="name" placeholder="Caller Full Names" value="{{ old('name') }}">
                        @error('name')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <span class="help-block"><small>Enter Caller's Full Three Names</small></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="caller_phone">Caller's Phone Number</label>
                    <div class="col-md-10">
                        <input type="phone" id="caller_phone" wire:model="caller_phone" class="form-control" placeholder="Caller's Phone" value="{{ old('caller_phone') }}">
                        @error('caller_phone')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="kin_name">Next Of Kin's Names </label>
                    <div class="col-md-10">
                        <input type="text" id="kin_name" wire:model="kin_name" class="form-control" placeholder="Next Of Kin's Names" value="{{ old('kin_name') }}">
                        @error('kin_name')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <span class="help-block"><small>Enter Next Of Kin's Names</small></span>
                    </div>
                </div>
            </div>
        @endif

        {{-- STEP 2 --}}
        @if ($currentStep == 2)
            <div class="form-section step-2">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="kin_phone">Next Of Kin's Phone Number</label>
                    <div class="col-md-10">
                        <input type="phone" id="kin_phone" wire:model="kin_phone" class="form-control" placeholder="Kin's Phone" value="{{ old('kin_phone') }}">
                        @error('kin_phone')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="victim_name">Victim's Names </label>
                    <div class="col-md-10">
                        <input type="text" id="victim_name" wire:model="victim_name" class="form-control" placeholder="Victim's Names" value="{{ old('victim_name') }}">
                        @error('victim_name')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <span class="help-block"><small>Enter Victim's Names</small></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="victim_gender">Victim's Gender</label>
                    <div class="col-sm-10">
                        <select class="form-control" wire:model="victim_gender">
                            <option selected> Select Gender </option>
                            <option value="M"> Male </option>
                            <option value="F"> Female </option>
                            <option value="Other"> Other/Unknown </option>
                        </select>
                        @error('victim_gender')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        @endif

        {{-- STEP 3 --}}
        @if ($currentStep == 3)
            <div class="form-section step-3">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="location_id">Preferred Hospital</label>
                    <div class="col-sm-10">
                        <select class="form-control" wire:model="location_id">
                            <option selected> Select Desired Hospital </option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}"> {{ $location->hospital }} </option>
                            @endforeach
                        </select>
                        @error('location_id')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Assign Ambulance</label>
                    <div class="col-sm-10">
                        <select class="form-control" wire:model="assigned_ambulance">
                            <option selected>Select Ambulance Driver</option>
                            @foreach ($ambulance_array as $ambulance)
                                <option value="{{ $ambulance->id }}">
                                    {{ $ambulance->reg_no }} With Driver:
                                    @if ($driver = $ambulance->driver)
                                    {{ $driver['name'] }}
                                    @else
                                        {{ "No Driver Assigned" }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('assigned_ambulance')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Emergency Description</label>
                    <div class="col-sm-10">
                        <textarea wire:model="emergency_details" class="form-control" rows="5" placeholder="Enter Emergency Details Here"></textarea>
                        @error('emergency_details')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        @endif

        <div class="form-navigation m-t-20">
            <div class="form-group m-t-20">

                @if ($currentStep == 1)
                    <div></div>
                @endif

                @if ($currentStep == 2 || $currentStep == 3)
                    <div class="col-md-6 float-left">
                        <button type="button" class="btn btn-danger btn-block clear:left m-t-20" wire:click="decreaseStep()">Previous</button>
                    </div>
                @endif

                @if ($currentStep == 1 || $currentStep == 2)
                    <div class="col-md-6 float-right">
                        <button type="button" class="btn btn-success btn-block clear:right m-t-20" wire:click="increaseStep()">Next</button>
                    </div>
                @endif

                @if ($currentStep == 3)
                    <div class="col-md-6 float-right">
                        <button type="submit" class="btn btn-primary btn-block waves-effect waves-light clear:right m-t-20">Dispatch Ambulance</button>
                    </div>
                @endif
            </div>
        </div>

    </form>
</div>
