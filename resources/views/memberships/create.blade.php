<x-layout title="Issue Membership Card">
    <main class="memberships-create-blade">
        <div class="container">
            <div class="card mt-5 p-md-5 shadow-lg">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between">
                        <h5 class="text-center">{{ $student->centre->name }}</h5>
                        <div class="d-flex justify-content-between">
                            <span>Issue Membership Card</span> &nbsp;
                            <span>Student Name: {{ $student->name }}</span>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="post" id="issue-doc-form">
                        <div class="row">
                            <div class="form-group col-md-6 mt-3">
                                <label class="form-label">Validity Starting Date</label>
                                <input type="date" required class="form-control" id="starting_date" name="starting_date">
                            </div>
                            <div class="form-group col-md-6 mt-3">
                                <label class="form-label">Validity Ending Date</label>
                                <input type="date" required class="form-control" id="completion_date" name="completion_date">
                            </div>
                            <div class="form-group col-md-12 mt-3">
                                <button class="btn btn-success" type="submit">Issue Documents</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-layout>