<x-layout title="Centres">
    <main class="centres-index-blade main-content-div">
        <x-centre-tab />

        <div class="container-fluid pb-5">
            <div class="card shadow p-md-3">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between">
                        <h2>Centres List</h2>
                        <h2>Total Records: <strong>{{ $totalCentres }}</strong></h2>
                    </div>

                    @session('error') <p class="text-danger">{{ session('error') }}</p> @endsession
                </div>

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="42" align="left" bgcolor="#ECE9D8"><strong>S.No</strong></th>
                                <th width="25" align="left" bgcolor="#ECE9D8">&nbsp;</th>
                                <th width="161" align="left" nowrap="nowrap" bgcolor="#ECE9D8">Category</th>
                                <th width="161" align="left" nowrap="nowrap" bgcolor="#ECE9D8">Type</th>
                                <th width="161" align="left" nowrap="nowrap" bgcolor="#ECE9D8"><strong>Centre Name</strong></th>
                                <th width="161" align="left" nowrap="nowrap" bgcolor="#ECE9D8"><strong>Upload Assessment Docs</strong></th>
                                <th width="64" align="left" nowrap="nowrap" bgcolor="#ECE9D8">Code</th>
                                <th width="92" align="left" nowrap="nowrap" bgcolor="#ECE9D8">Address</th>
                                <th width="102" align="left" nowrap="nowrap" bgcolor="#ECE9D8">Email</th>
                                <th width="102" align="left" nowrap="nowrap" bgcolor="#ECE9D8">Contact Person</th>
                                <th width="102" align="left" nowrap="nowrap" bgcolor="#ECE9D8">Mobile</th>
                                <th width="65" align="left" bgcolor="#ECE9D8">&nbsp;</th>
                                <th width="65" align="left" bgcolor="#ECE9D8">&nbsp;</th>
                                <th width="65" align="left" bgcolor="#ECE9D8">&nbsp;</th>
                                <th width="65" align="left" bgcolor="#ECE9D8">&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($centres as $centre)
                                <tr>
                                    <td align="left">{{ $loop->iteration }}</td>
                                    <td align="left"><input type="checkbox" name="delete[]" value="{{ $centre->id }}" /></td>
                                    <td align="left">{{ $centre->centreCategory->name }}</td>
                                    <td align="left">{{ $centreTypes[$centre->type] }}</td>
                                    <td>
                                        <a target="_blank" href="{{ route('centres.students.create', ['centre' => $centre, 'country' => $centre->country_id, 'state' => $centre->state_id]) }}">
                                            {{ $centre->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a target="_blank" href="/student_assmt_doc.php?centerId={{ $centre->id }}">
                                            Upload Assessment Docs
                                        </a>
                                    </td>
                                    <td align="left">{{ $centre->code }}</td>
                                    <td align="left">{{ strip_tags($centre->address) }}</td>
                                    <td align="left">{{ $centre->email }}</td>
                                    <td align="left">{{ $centre->contact_person }}</td>
                                    <td align="left">{{ $centre->mobile }}</td>
                                    <td align="left">Uploads</td>
                                    <td align="left" nowrap="nowrap">
                                        <a href="centre_mapping.php?centreid={{ $centre->id }}&TB_iframe=true&keepthis=true&width=800&height=500" title="Allot Courses" class="thickbox">Centre Mapping</a>
                                    </td>
                                    <td align="left" nowrap="nowrap">
                                        <a href="allot_courses.php?centreid={{ $centre->id }}&TB_iframe=true&keepthis=true&width=800&height=500" title="Allot Courses" class="thickbox">Allot Courses</a>
                                    </td>
                                    <td class="d-flex justify-content-center gap-1">
                                        <a class="btn btn-primary text-white" href="{{ route('centres.edit', $centre) }}" target="_blank">Edit</a>

                                        <form action="{{ route('centres.destroy', $centre) }}" method="post" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this?');">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </main>

    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                paging: true,
                ordering: true,
                info: true,
                dom: 'Bfrtip',
                lengthMenu: [
                    [10, 50, 100, 500, 1000, -1],
                    [10, 50, 100, 500, 1000, "All"]
                ],
                buttons: ['excelHtml5', 'pdfHtml5', 'pageLength']
            });
        });
    </script>
</x-layout>