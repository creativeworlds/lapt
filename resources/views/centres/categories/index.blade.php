<x-layout title="Centre Categories">
    <main class="centres-categories-index-blade main-content-div">
        <x-centre-tab />

        <div class="container pb-5">
            <div class="card shadow-lg p-md-3">
                <div class="card-header bg-white">
                    <h2>Centers Category List : <strong>{{ $totalCentreCategories }} Records</strong></h2>

                    @session('error') <p class="text-danger">{{ session('error') }}</p> @endsession
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="CentreCategoryTable" class="tablesorter table table-hover">
                            <thead>
                                <tr>
                                    <th><strong>S.No</strong></th>
                                    <th><strong>Category Name</strong></th>
                                    <th>Sort Order</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($centreCategories as $centreCategory)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $centreCategory->name }}</td>
                                        <td>{{ $centreCategory->sort_order }}</td>
                                        <td class="d-flex justify-content-center gap-1">
                                            <a class="btn btn-primary text-white" href="{{ route('centre-categories.edit', $centreCategory) }}">Edit</a>

                                            <form action="{{ route('centre-categories.destroy', $centreCategory) }}" method="post" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this?');">
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
        </div>
    </main>
</x-layout>