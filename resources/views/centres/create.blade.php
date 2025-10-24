<x-layout title="Add Centre">
    <main class="centres-create-blade main-content-div">
        <x-centre-tab />

        <div class="container mb-5">
            <div class="col-md-12">
                <div class="card shadow-lg p-md-3">
                    <div class="card-header bg-white">
                        <h2>Add New Centre</h2>

                        @session('message') <p class="alert alert-success">{{ session('message') }}</p> @endsession
                    </div>

                    <div class="card-body">
                        <form action="{{ route('centres.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">Select Category</label>
                                    <select class="form-control form-select" name="centre_category_id" id="centreCategoryId">
                                        @foreach ($centreCategories as $centreCategory)
                                            <option value="{{ $centreCategory->id }}" @selected(old('centre_category_id') == $centreCategory->id)>{{ $centreCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 mt-3 mt-lg-0">
                                    <label class="form-label">Centre Type</label>
                                    <select class="form-control form-select" name="type" id="type">
                                        @foreach ($centreTypes as $centreType)
                                            <option value="{{ $loop->iteration }}" @selected(old('type') == $loop->iteration)>{{ $centreType }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Enter Centre Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" />
                                    @error('name') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Enter Centre Code</label>
                                    <input type="text" class="form-control" name="code" id="code" value="{{ old('code') }}" />
                                    @error('code') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="form-group col-md-12 mt-3">
                                    <label class="form-label">Address</label>
                                    <textarea cols="45" rows="5" class="ckeditor" name="address" id="address">{{ old('address') }}</textarea>
                                    @error('address') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Country</label>
                                    <select name="country_id" class="form-control country form-select" id="countryId" onchange="getStates(this.value)">
                                        <option value="" selected="selected">-- Select Country --</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" @selected(old('country_id') == $country->id)>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">State</label>
                                    <select class="form-control form-select state" name="state_id" id="stateId">
                                        <option value="" selected="selected">-- Select State --</option>
                                        
                                        @if(old('country_id'))
                                            @foreach ($countries->find(old('country_id'))->states as $state)
                                                <option value="{{ $state->id }}" @selected(old('state_id') == $state->id)>{{ $state->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('state_id') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- ===================== NEW: Invoice & Tax Info ===================== -->
                                <div class="form-group col-md-12 mt-3">
                                    <h3 class="mt-3 mb-0">Invoice &amp; Tax Info</h3>
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Currency</label>
                                    <select name="currency" id="currency" class="form-control form-select currency">
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency }}" @selected(old('currency') == $currency)>{{ $currency }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Tax Type</label>
                                    <select name="tax_type" id="taxType" class="form-control form-select tax-type">
                                        @foreach ($taxTypes as $taxType)
                                            <option value="{{ $taxType }}" @selected(old('tax_type') == $taxType)>{{ $taxType }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">GST / VAT Number</label>
                                    <input type="text" name="gst_number" id="gstNumber" class="form-control" value="{{ old('gst_number') }}" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Preferred Seller</label>
                                    <select name="preferred_seller" id="preferredSeller" class="form-control form-select">
                                        @foreach ($preferredSellers as $preferredSeller)
                                            <option value="{{ $preferredSeller }}" @selected(old('preferred_seller') == $preferredSeller)>{{ $preferredSeller }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">GST Mode (Auto)</label>
                                    <input type="text" id="gstModeDisplay" class="form-control"  readonly />
                                    <input type="hidden" name="gst_mode" id="gstMode" value="{{ old('gst_mode') }}"  />
                                    <small class="text-muted">If Country = India: CGST+SGST when Buyer State = Seller State (Delhi), otherwise IGST. UK/Other countries: VAT or Export (0%).</small>
                                </div>
                                <!-- =================== END NEW: Invoice & Tax Info =================== -->

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" name="city" id="city" size="30" value="{{ old('city') }}" />
                                    @error('city') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Contact Person</label>
                                    <input type="text" class="form-control" name="contact_person" id="contactPerson" value="{{ old('contact_person') }}" />
                                    @error('contact_person') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="text" class="form-control" name="mobile" id="mobile" value="{{ old('mobile') }}" />
                                    @error('mobile') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Fax</label>
                                    <input type="text" class="form-control" name="fax" id="fax" value="{{ old('fax') }}" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" />
                                    @error('email') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Website</label>
                                    <input type="text" name="website" class="form-control" id="website" value="{{ old('website') }}" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Facebook</label>
                                    <input type="text" name="facebook" class="form-control" id="facebook" value="{{ old('facebook') }}" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Twitter</label>
                                    <input type="text" name="twitter" class="form-control" id="twitter" value="{{ old('twitter') }}" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Instagram</label>
                                    <input type="text" name="instagram" class="form-control" id="instagram" value="{{ old('instagram') }}" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">LinkedIn</label>
                                    <input type="text" name="linkedin" class="form-control" id="linkedin" value="{{ old('linkedin') }}" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Password</label>
                                    <input type="text" name="password" class="form-control" id="password" />
                                    @error('password') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Upload Chairman Signature</label>
                                    <input type="file" accept="image/*" name="chairman_sign" class="form-control" id="chairmanSign" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Upload Examiner Signature</label>
                                    <input type="file" accept="image/*" name="examiner_sign" class="form-control" id="examinerSign" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Upload Center Logo</label>
                                    <input type="file" accept="image/*" name="logo" class="form-control" id="logo" />
                                </div>

                                <div class="form-group col-md-12 mt-3">
                                    <button type="submit" class="btn px-5 btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const getStates = async (countryId) => {
            const stateSelect = document.getElementById('stateId');
            const states = await (await fetch(`/countries/${countryId}/states`)).json();

            // Clear old options
            stateSelect.innerHTML = '<option value="">-- Select State --</option>';

            // Add new options
            states.forEach(state => {
                let opt = document.createElement('option');
                opt.value = state.id;
                opt.textContent = state.name;
                stateSelect.appendChild(opt);
            });
        }
    </script>

    <!-- ===== NEW: Auto currency/tax/GST mode logic (safe, additive) ===== -->
    <script>
        // Seller state mapping (for GST comparison). For now, Delhi for India GST deposits.
        function getSellerState() {
            var seller = $('#preferredSeller').val();
            // Both options that bill India deposit GST via the India GSTIN registered in Delhi
            // If you ever add another Indian seller, update here accordingly.
            if (seller === 'Future Life Education Pvt Ltd') return 'Delhi';
            if (seller === 'London Academy of Professional Training Ltd') return 'Delhi'; // GST deposited via India entity
            return 'Delhi';
        }

        function updateBillingDerivedFields() {
            var countryText = $('#countryId option:selected').text().trim();
            var stateText = $('#stateId option:selected').text().trim();
            var sellerState = getSellerState();

            // Set defaults based on country
            if (countryText === 'India') {
                $('#currency').val('INR');
                $('#taxType').val('GST');

                // Decide GST mode based on state comparison (only if a state is chosen)
                if (stateText && stateText !== '-- Select State --') {
                    if (stateText.toLowerCase() === sellerState.toLowerCase()) {
                        $('#gstMode').val('CGST + SGST');
                        $('#gstModeDisplay').val('CGST + SGST');
                    } else {
                        $('#gstMode').val('IGST');
                        $('#gstModeDisplay').val('IGST');
                    }
                } else {
                    $('#gstMode').val('');
                    $('#gstModeDisplay').val('');
                }

            } else if (countryText === 'United Kingdom' || countryText === 'UK' ||
                countryText === 'United Kingdom of Great Britain and Northern Ireland') {
                $('#currency').val('GBP');
                $('#taxType').val('VAT');
                $('#gstMode').val('VAT');
                $('#gstModeDisplay').val('VAT');
            } else if (countryText && countryText !== '-- Select Country --') {
                // Other countries → treat as export for Indian GST purposes
                // Leave currency as user-selected; mark tax appropriately
                if ($('#taxType').val() === 'GST') { $('#taxType').val('None'); }
                $('#gstMode').val('Export');
                $('#gstModeDisplay').val('Export (0%)');
            } else {
                // No country selected
                $('#gstMode').val('');
                $('#gstModeDisplay').val('');
            }
        }

        // Hook up change listeners (country, state, seller)
        $(document).on('change', '#countryId', updateBillingDerivedFields);
        $(document).on('change', '#stateId', updateBillingDerivedFields);
        $(document).on('change', '#preferredSeller', updateBillingDerivedFields);

        // Run once on load (in case of prefilled values or quick selections)
        $(function () { updateBillingDerivedFields(); });
    </script>
    <!-- ===== END NEW: Auto logic ===== -->
</x-layout>