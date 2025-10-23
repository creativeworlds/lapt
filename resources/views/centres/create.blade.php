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
                                    <select class="form-control form-select" name="category_id" id="categoryId">
                                        @foreach ($centreCategories as $centreCategory)
                                            <option value="{{ $centreCategory->id }}">{{ $centreCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 mt-3 mt-lg-0">
                                    <label class="form-label">Centre Type</label>
                                    <select class="form-control form-select" name="centre_type" id="centreType">
                                        @foreach ($centreTypes as $centreType)
                                            <option value="{{ $loop->iteration }}">{{ $centreType }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Enter Centre Name</label>
                                    <input type="text" class="form-control" name="name" id="name" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Enter Centre Code</label>
                                    <input type="text" class="form-control" name="code" id="code" />
                                </div>

                                <div class="form-group col-md-12 mt-3">
                                    <label class="form-label">Address</label>
                                    <textarea cols="45" rows="5" class="ckeditor" name="address" id="address"></textarea>
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Country</label>
                                    <select name="country_id" class="form-control country form-select" id="countryId" onchange="getStates(this.value)">
                                        <option value="" selected="selected">-- Select Country --</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">State</label>
                                    <select class="form-control form-select state" name="state_id" id="stateId">
                                        <option value="" selected="selected">-- Select State --</option>
                                    </select>
                                </div>

                                <!-- ===================== NEW: Invoice & Tax Info ===================== -->
                                <div class="form-group col-md-12 mt-3">
                                    <h3 class="mt-3 mb-0">Invoice &amp; Tax Info</h3>
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Currency</label>
                                    <select name="currency" id="currency" class="form-control form-select currency">
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency }}">{{ $currency }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Tax Type</label>
                                    <select name="tax_type" id="taxType" class="form-control form-select tax-type">
                                        @foreach ($taxTypes as $taxType)
                                            <option value="{{ $taxType }}">{{ $taxType }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">GST / VAT Number</label>
                                    <input type="text" name="gst_number" id="gstNumber" class="form-control" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Preferred Seller</label>
                                    <select name="preferred_seller" id="preferredSeller" class="form-control form-select">
                                        @foreach ($preferredSellers as $preferredSeller)
                                            <option value="{{ $preferredSeller }}">{{ $preferredSeller }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">GST Mode (Auto)</label>
                                    <input type="text" id="gstModeDisplay" class="form-control" value="" readonly />
                                    <input type="hidden" name="gst_mode" id="gstMode" value="" />
                                    <small class="text-muted">If Country = India: CGST+SGST when Buyer State = Seller State (Delhi), otherwise IGST. UK/Other countries: VAT or Export (0%).</small>
                                </div>
                                <!-- =================== END NEW: Invoice & Tax Info =================== -->

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" name="city" id="city" size="30" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Contact Person</label>
                                    <input type="text" class="form-control" name="contact_person" id="contactPerson" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="text" class="form-control" name="mobile" id="mobile" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" name="phone" id="phone" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Fax</label>
                                    <input type="text" class="form-control" name="fax" id="fax" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" id="description"></textarea>
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Website</label>
                                    <input type="text" name="website" class="form-control" id="website" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Facebook</label>
                                    <input type="text" name="facebook" class="form-control" id="facebook" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Twitter</label>
                                    <input type="text" name="twitter" class="form-control" id="twitter" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Instagram</label>
                                    <input type="text" name="instagram" class="form-control" id="instagram" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">LinkedIn</label>
                                    <input type="text" name="linkedin" class="form-control" id="linkedin" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Password</label>
                                    <input type="text" name="password" class="form-control" id="password" />
                                </div>

                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Upload Chairman Signature</label>
                                    <input name="chairman_sign" class="form-control" type="file" accept="image/*" id="chairmanSign" />
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
</x-layout>