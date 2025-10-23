<x-layout title="Edit Centre Category">
    <main class="centres-categories-edit-blade main-content-div">
        <x-centre-tab />

        <div class="container">
            <div class="card shadow-lg p-md-3">
                <div class="card-header bg-white">
                    <h2><span>Edit Centre Category</span></h2>

                    @session('message') <p class="notification n-success">{{ session('message') }}</p> @endsession
                </div>

                <div class="card-body">
                    <form action="{{ route('centre-categories.update', $centreCategory) }}" enctype="multipart/form-data" method="post">

                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" placeholder="Category Name" class="form-control" name="name" id="name" value="{{ $centreCategory->name }}" />
                        </div>

                        <div class="form-group mt-3">
                            <label class="form-label">Sort Order</label>
                            <input type="text" class="form-control" name="sort_order" id="sortorder" value="{{ $centreCategory->sort_order }}" />
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="submit-green px-5 btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-layout>