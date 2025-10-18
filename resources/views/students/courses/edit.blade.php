@php
    use App\Support\Facades\QRCode;
@endphp

<x-layout>
    <main class="students-courses-edit-blade">
        <div class="container py-5">
            <div class="card shadow-lg p-md-3">
                <div class="card-header bg-white">
                    <h3>Edit Student Course Details</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('students.courses.update', ['student' => $course->pivot->student_id, 'course' => $course->id]) }}" method="post" enctype="multipart/form-data" id="student-course-edit-form">

                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Registration Date</label>
                                <div class="form-control reado">{{ $course->pivot->registration_date }}</div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="form-label">Course</label>
                                <select name="course_id" size="1" class="TextArea1New form-control form-select" id="courseId">
                                    <option value="" selected="selected">Select One</option>
                                    @foreach ($courses as $c)
                                        <option value="{{ $c->id }}" @selected($course->pivot->course_id == $c->id)>{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6 mt-2">
                                <label class="form-label">Course Start Date</label>
                                <input type="date" name="start_date" id="startDate" class="one form-control" value="{{ $course->pivot->start_date }}" />
                            </div>

                            <div class="form-group col-md-6 mt-2">
                                <label class="form-label">Course End Date</label>
                                <input type="date" name="end_date" id="endDate" class="one form-control" value="{{ $course->pivot->end_date }}" />
                            </div>

                            <div class="form-group col-md-6 mt-2">
                                <label class="form-label">Course Status</label>
                                <select class="form-control form-select" name="course_status" id="courseStatus">
                                    <option value="1" @selected($course->pivot->course_status == 1)>Active</option>
                                    <option value="0" @selected($course->pivot->course_status == 0)>Inactive</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6 mt-2">
                                <label class="form-label">Payment</label>
                                <select class="form-control form-select" name="payment" id="payment">
                                    <option value="Online" @selected($course->pivot->course_status == "Online")>Active</option>
                                    <option value="Offline" @selected($course->pivot->course_status == "Offline")>At Partner Centre</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6 mt-2">
                                <label class="form-label">Payment Status</label>
                                <select class="form-control form-select" name="payment_status" id="paymentStatus">
                                    <option value="Pending" @selected($course->pivot->payment_status == "Pending")>Pending</option>
                                    <option value="Online" @selected($course->pivot->payment_status == "Done")>Done</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6 mt-2">
                                <label class="form-label">Certification Status</label>
                                <select class="form-control form-select" name="status" id="status">
                                    <option value="Enquiry" @selected($course->pivot->status == "Enquiry")>Enquiry</option>
                                    <option value="Registered" @selected($course->pivot->status == "Registered")>Registered</option>
                                    <option value="Certified" @selected($course->pivot->status == "Certified")>Certified</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6 mt-2">
                                <label class="form-label">Certificate Id</label>
                                <input class="form-control" name="certificate_id" type="text" id="certificateId" value="{{ $course->pivot->certificate_id }}">
                            </div>

                            <div class="form-group col-md-6 mt-2">
                                <label class="form-label upload_section">Upload Certificate (<strong>in PDF Only</strong>)</label>
                                <div class="d-flex gap-1 justify-content-between">
                                    <select class="form-control" name="certificate_names[]" id="fileNamesPdf">
                                        <option value="">Select File Name </option>
                                        <option value="marksheet">Marksheet</option>
                                        <option value="certificate">Certificate</option>
                                        <option value="admit">Admit Card</option>
                                        <option value="letter">Letter</option>
                                        <option id='customName' value="custom">Custom File</option>
                                    </select>
                                    <input accept=".pdf" class="form-control" type="file" name="certificate[]" id="certificate">
                                </div>
                            </div>

                            <div class="form-group col-md-12 mt-3">
                                <button type="submit" class="submit px-5 btn btn-success" id="update">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-lg p-md-3 my-4">
                <div class="card-body">
                    <div class="row">
                        @if($student->member_card_status == 1)
                                <div class="col-md-4">
                                    <div class="card-body p-4 bg-light shadow-sm">
                                        @php 
                                            $fileName = "{$student->id}_membership.pdf";
                                        @endphp

                                        <a target="_blank" class="me-2" href="{{ asset("storage/certificates/{$fileName}") }}">Membership Card</a> <br />
                                        <a target="_blank" href="{{ QRCode::url($fileName)->getUrl() }}">QR Check Link</a> <br />
                                        <form action="{{ route('memberships.delete', $student)}}" method="post" class="d-inline-block" onsubmit="return confirm('Are you sure to delete this? \n{{ $student->name }} Membership Card');">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-light">Delete</button>
                                        </form> <br />
                                    </div>
                                </div>
                            @endif

                    </div>
                </div>
            </div>

            <div class="card shadow-lg p-md-3">
		        <div class="card-header bg-white">
				    <h3>For manual QR code placement</h3>
		        </div>

		        <div class="card-body">
			        <div style="display: flex;">
				        <input class="form-control" style="width: 300px;" id="qrfilename" placeholder="File Name">
				        <button type="button" class="btn btn-primary border-0" id="generateqr">Show QR</button>
			        </div>

			        <div style="min-height: 100px;">
				    <img style="display: none;" id="generatedQR" src="https://chart.googleapis.com/chart?chs=300x300&amp;cht=qr&amp;chl=https://verification.hotelierscollege.com/verification.php?verify=NjM5XzUyODNfMjAwMjgyNF9xenA&amp;choe=UTF-8" title="Link to dmc" />
			    </div>
			    <span>File name contains following: <br /> marksheet, certificate, admit etc</span>
		    </div>
	    </div>
    </main>

    <script>
        $(function () {
            $('#fileNamesPdf').change(function () {
                val = $('#fileNamesPdf').val();

                // prompt alert for custom file name
                if (val == 'custom') {
                    let fileName = prompt('Enter custom file name:').toLowerCase();
                    $('#customName').val(fileName).text(fileName);
                }
            });

            if ({{ $course->pivot->certificate_id ?? 0 }} < 1) {
                document.querySelector('.upload_section ').nextElementSibling.style.pointerEvents = 'none';
                document.querySelector('.upload_section ').nextElementSibling.style.opacity = 0.4;
                document.querySelector('.upload_section').innerHTML = "<b>Certificate Id required.</b>"
                document.querySelector('.upload_section').style.color = 'darkred'
            }

            // document.querySelector('body').insertAdjacentHTML('beforeend', `<button id='insert_file'>add File</button>`)

            // $('#generateqr').click(function() {
            // 	title = document.querySelector('#qrfilename').value
            // 	document.querySelector('#generatedQR').setAttribute('src', '')
            // 	document.querySelector('#generatedQR').style.display = 'none'

            // 	fetch(document.querySelector('form').getAttribute('action') + '&title=' + title, {
            // 		method: 'POST',

            // 	}).then(r => r.json()).then(r => {
            // 		console.log(r)
            // 		var url = `https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=${r.url}&choe=UTF-8`
            // 		url = (url)
            // 		document.querySelector('#generatedQR').setAttribute('src', url)
            // 		document.querySelector('#generatedQR').style.display = 'block'
            // 	});
            // })

            $('#generateqr').click(function () {
                var title = document.querySelector('#qrfilename').value;
                document.querySelector('#generatedQR').setAttribute('src', '');
                document.querySelector('#generatedQR').style.display = 'none';

                var qrUrl = 'generate_qr.php?title=' + title;

                fetch(qrUrl, {
                    method: 'GET',
                }).then(r => r.text()).then(qrData => {
                    document.querySelector('#generatedQR').setAttribute('src', qrData);
                    document.querySelector('#generatedQR').style.display = 'block';
                });
            });


            $('#insert_file').click(function () {
                document.querySelector('tbody tr:last-child').insertAdjacentHTML('beforebegin', `
			<tr>
				<td nowrap="nowrap" bgcolor="#ECE9D8" class="personal">Upload Certificate(<strong>in PDF Only</strong>)</td>
				<td nowrap="nowrap" class="personal"><label>
				<input type="text" name="certificatename[]" id="pic1" placeholder='certificate Name '> <br>
				<input type="file" name="certificate[]" id="pic1">
				</td>
			</tr>
			`)
            })
            $('#insert_file').click(function () {
                document.querySelector('tbody tr:last-child').insertAdjacentHTML('beforebegin', `
			<tr>
				<td nowrap="nowrap" bgcolor="#ECE9D8" class="personal">Upload Certificate(<strong>in PDF Only</strong>)</td>
				<td nowrap="nowrap" class="personal"><label>
				<input type="text" name="certificatename[]" id="pic1" placeholder='certificate Name '> <br>
				<input type="file" name="certificate[]" id="pic1">
				</td>
			</tr>
			`)
            })
        });
    </script>
</x-layout>