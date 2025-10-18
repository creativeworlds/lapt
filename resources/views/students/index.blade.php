@php
    use App\Enums\PerPage;
    use App\Support\Facades\QRCode;
@endphp

<x-layout title="Students">
    <main class="students-index-blade main-content-div">
        <div class="container-fluid pt-3">
            <div class="cards shadows">
                <div class="card-bodys">
                    <h2 class="text-center">Total Records: <strong>{{ $totalStudents }}</strong></h2>

                    <div class="d-flex justify-content-between ">
                        <div class="col-md-3 ms-0 ps-0">
                            <form method="get" class="d-flex align-items-center">
                                <h4 for="per_page" class="me-2 mb-0 text-nowrap">Records per page:</h4>
                                <div class="input-group">
                                    <select class="form-select" id="per_page" name="per_page">
                                        @foreach (PerPage::cases() as $i)
                                            <option @selected($per_page == $i)>{{ $i }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-success">Go</button>
                                </div>
                                <input type="hidden" name="page" value="{{ $students->currentPage() }}">
                                <input type="hidden" name="search" value="{{ $search }}">
                            </form>
                        </div>

                        <div class="col-md-3 text-end pe-0 me-0">
                            <form method="get" class="d-flex align-items-center">
                                <h4 for="search" class="me-2 text-nowrap mb-0">Database Search:</h4>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="search" name="search" placeholder="Search..." value="{{ $search }}">
                                    <button type="submit" class="btn btn-success">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="d-flex mt-4 align-items-center gap-1 justify-content-end">
                        <a href="#">Download Excel Format</a>
                        <a href="studentbulkregister.php"><span class="btn btn-success">Bulk Student registration</span></a>
                    </div>

                    @session('error') <p class="text-danger">{{ session('error') }}</p> @endsession
                    @session('message') <p class="text-success">{{ session('message') }}</p> @endsession

                    <div>
                        <h2>Students</h2>
                        <div class="module-table-body">
                            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="45" align="left" bgcolor="#ECE9D8"><strong>S.No</strong></th>
                                        <th width="73" align="left" bgcolor="#ECE9D8">Post Date</th>
                                        <th width="386" align="left" bgcolor="#ECE9D8">Course</th>
                                        <th width="142" align="left" bgcolor="#ECE9D8">Centre</th>
                                        <th width="81" align="left" bgcolor="#ECE9D8">Photo</th>
                                        <th width="81" align="left" bgcolor="#ECE9D8">Documents Proof</th>
                                        <th width="81" align="left" bgcolor="#ECE9D8">Invoice link</th>
                                        <th width="81" align="left" bgcolor="#ECE9D8">Name</th>
                                        <th width="81" align="left" bgcolor="#ECE9D8">Register By</th>
                                        <th width="175" align="left" bgcolor="#ECE9D8">Email</th>
                                        <th width="175" align="left" bgcolor="#ECE9D8">Mobile</th>
                                        <th width="175" align="left" bgcolor="#ECE9D8">Result Status</th>
                                        <th width="40" align="left" bgcolor="#ECE9D8">Certi. Status</th>
                                        <th width="40" align="left" bgcolor="#ECE9D8">Membership Card Status</th>
                                        <th width="72" align="left" bgcolor="#ECE9D8">Change Status</th>
                                        <th width="41" class="text-center" bgcolor="#ECE9D8">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td align="left">{{ $loop->iteration }}</td>
                                            <td align="left" nowrap="nowrap">{{ $student->created_at->format('Y-m-d') }}</td>
                                            <td align="left" nowrap="nowrap" style="display: flex; flex-direction: column-reverse;">
                                                <table width="100%" border="1" cellpadding="4" cellspacing="0">
                                                    @if($student->courses->count() != 0)
                                                        @foreach($student->courses as $course)
                                                            <tr>
                                                                <td bgcolor="#FFFFCC">
                                                                    - <a title="Edit {{ $course->name }}" href="{{ route('students.courses.edit', ['course' => $course, 'student' => $student, 'TB_iframe' => 'true', 'keepthis' => 'true', 'width' => 800, 'height' => 450]) }}" class="thickbox">{{ $course->name }}</a>
                                                                </td>
                                                                <td bgcolor="#FFFFCC">{{ $course->pivot->certificate_id }}</td>
                                                                <td bgcolor="#FFFFCC">
                                                                    <a href="payments.php?studentid={{ $student->id }}&courseid={{ $course->id }}&TB_iframe=true&keepthis=true&width=800&height=350" class="thickbox">Payment</a>
                                                                </td>
                                                                <td bgcolor="#FFFFCC">
                                                                    <a href="resetexam.php?studentid={{ $student->id }}&courseid={{ $course->id }}&TB_iframe=true&keepthis=true&height=200" class="thickbox">Reset</a>
                                                                </td>
                                                                <td bgcolor="#FFFFCC">
                                                                    <a href="delete_courses.php?id={{ $course->id }}&studentid={{ $student->id }}&courseid={{ $course->id }}&TB_iframe=true&keepthis=true&width=800&height=350" class="thickbox">Delete</a>
                                                                </td>
                                                                <td bgcolor="#FFFFCC">
                                                                    <a target="_blank" href="declare_result.php?studentid={{ $student->id }}&courseid={{ $course->id }}">Declare Result</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <div class="document_links">
                                                                    <div class="row">
                                                                        @if($student->member_card_status == 1)
                                                                            <div class="col-3">
                                                                                <center>
                                                                                    @php 
                                                                                        $fileName = "{$student->id}_membership.pdf";
                                                                                    @endphp

                                                                                    <a class="white" target="_blank" href="{{ asset("storage/certificates/{$fileName}") }}">Membership Card</a>
                                                                                    <br />
                                                                                    <a target="_blank" href="{{ QRCode::url($fileName)->getUrl() }}" class="white">QR Check Link</a>
                                                                                    <br />
                                                                                    <form action="{{ route('memberships.delete', $student)}}" method="post" class="d-inline-block" onsubmit="return confirm('Are you sure to delete this? \n{{ $student->name }} Membership Card');">
                                                                                        @csrf
                                                                                        @method('delete')
                                                                                        <button type="submit" class="btn btn-light">Delete</button>
                                                                                    </form>
                                                                                    <br /> <br />
                                                                                    <x-couriered-status :$student name="membership" />
                                                                                </center>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </table>
                                            </td>

                                            <td>{{ $student->centre->name }}</td>
                                            <td nowrap="nowrap">
                                                <img class="image-display" src="{{ asset('storage/' . $student->photo) }}" alt="Student Photo" width="100">
                                            </td>
                                            <td>
                                                <div class="documents-images">
                                                    <div class="d-flex">
                                                        @if($student->id_card)
                                                            <div class="document-single-item">
                                                                <h6>ID Card proof</h6>
                                                                <a target="_blank" href="{{ asset('storage/' . $student->id_card) }}">
                                                                    <img class="image-display" src="{{ asset('storage/' . $student->id_card) }}" alt="Student ID Card Proof" />
                                                                </a>
                                                            </div>
                                                        @endif
                                                        @if($student->edu_proof)
                                                            <div class="document-single-item">
                                                                <h6>Education proof</h6>
                                                                <a target="_blank" href="{{ asset('storage/' . $student->id_card) }}">
                                                                    <img class="image-display" src="{{ asset('storage' . $student->id_card) }}" alt="Student Education proof" />
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td nowrap="nowrap">
                                                @if (trim($student->invoice_link) != "")
                                                    <a target="_blank" href="{{ $student->invoice_link }}">Payment Done</a>
                                                @endif
                                            </td>
                                            <td nowrap="nowrap">{{ $student->name }}</td>
                                            <td nowrap="nowrap">{{ $student->registered_by }}</td>
                                            <td nowrap="nowrap">{{ $student->email }}</td>
                                            <td nowrap="nowrap">{{ $student->mobile }}</td>
                                            <td nowrap="nowrap">
                                                <div class="d-flex justify-content-center flex-column">
                                                    <span @if($student->result_status !== null) class="text-center badge py-3 {{ $student->result_status == 'fail' ? 'bg-danger' : 'bg-success' }} @endif">
                                                        {{ $student->result_status ?? 'N/A' }}
                                                    </span>
                                                </div>
                                                @if($student->result_status == 'pass')
                                                    <div class="mt-2">
                                                        <a target="_blank" href="diploma_marksheet?studentid={{ $student->id }}&courseid={{ $student->course->id }}&centreid={{ $student->centre->id }}" class="btn text-white btn-info">Diploma/Marksheet</a>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $student->summary_status }}</td>
                                            <td>
                                                @if($student->member_card_status == 1)
                                                    <span class="badge mb-2 bg-success">Card is Issued</span>
                                                @else
                                                    <span class="badge mb-2 bg-danger">Card is Not Issued</span>
                                                @endif

                                                @if($student->summary_status == "Certified")
                                                    <a class="btn btn-info text-white" href="membershipgen?studentid={{ $student->id }}&courseid={{ $student->course->id }}&centreid={{ $student->centre->id }}">Issue New Membership</a>
                                                @endif
                                            </td>
                                            {{-- <td class="">
                                                <div class="badge mt-2 py-3 {{ $student->status ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $student->status ? 'Already Approved' : 'Not Approved' }}
                                                </div>
                                            </td> --}}
                                            <td>
                                                <div class="text-center">
                                                    @if($student->status)
                                                        <a class="btn px-5 text-center btn-danger" title="Click this button to cancel the student's approval." onclick="confirmUnapproveAction({{ $student->id }}, {{ $student->email }})">Unapprove</a>
                                                    @endif

                                                    @if($student->status == 0)
                                                        <a class="btn px-5 text-white btn-success" title="Click this button to approve the student" href="students.php?cmd=approve&id={{ $student->id }}">Approve</a>
                                                        <a class="btn mt-1 px-5 text-center btn-danger" title="Click this button to cancel the student's approval." onclick="confirmUnapproveAction({{ $student->id }}, '{{ $student->email }}')">Unapprove</a>
                                                    @endif

                                                    @if($student->certificate)
                                                        <a href="{{ route('certificate.pdf', $student->certificate) }}" class="btn text-white mt-1 btn-primary">Issue Documents</a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center gap-2">
                                                    <a class="btn btn-sm btn-warning text-white thickbox" title="Details of {{ $student->name }}" href="details.php?id={{ $student->id }}&width=800&height=600&TB_iframe=true">Details</a>
                                                    <a class="btn btn-sm btn-primary text-white" target="_blank" title="Edit {{ $student->name }}" href="{{ route('students.edit', $student) }}">Edit</a>

                                                    <form action="{{ route('students.destroy', $student) }}" method="post" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this centre?');">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-danger text-white">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <x-pagination :currentPage="$students->currentPage()" :lastPage="$students->lastPage()" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script language="javascript">
        function del(x) {
            if (confirm("Are you sure to delete?")) {
                window.location = x;
                return true;
            }
        }

        $(document).ready(function () {
            var table = $('#example').DataTable({
                "paging": false,
                "ordering": true,
                "info": false,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Export to Excel'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Export to PDF'
                    },
                    {
                        text: 'Export Photos',
                        action: function (e, dt, node, config) {
                            window.location.href = 'download.php'; // Redirect to download.php
                        }
                    },

                    {
                        text: 'Export Data to CSV',
                        action: function (e, dt, node, config) {
                            window.location.href = 'downloadCSV.php'; // Redirect to download.php
                        }
                    }
                ]
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');
        });


        function confirmUnapproveAction(id, email) {
            if (confirm("Are you sure you want to unapprove this student?")) {
                let reason = prompt('What is the reason for unapproving this student?');
                if (reason) {
                    window.location.href = `students.php?cmd=unapprove&id=${id}&reason=${encodeURIComponent(reason)}&email=${email}`;
                }
            }
        }
    </script>

    <script>
        function deleteData() {
            if (confirm('Are you sure to delete this?')) {

                var url_pdf = document.querySelector('input[name="pdf"]').value;

                fetch('students_courses_edit.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'delete&pdf=' + encodeURIComponent(url_pdf)
                })
                    .then(response => response.text())
                    .then(data => {
                        // Handle the response from the server if needed
                        window.location.reload();
                        console.log(data);
                    })
                    .catch(error => {
                        // Handle errors if the request fails
                        console.error('Error:', error);
                    });
            }
        }
    </script>

    <script>
        function deleteMemberCard(formId) {

            if (confirm('Are you sure to delete this?' + formId)) {
                const form = document.getElementById("deleteForm_" + formId);
                console.log("form", form);
                const formData = new FormData(form);

                fetch("students_courses_edit.php", {
                    method: "POST",
                    body: formData,
                })
                    .then(response => response.text())
                    .then(result => {
                        alert('Deleted successfully');
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error("Error:", error);
                    });
            }
        }
    </script>
</x-layout>