<x-layout title="Add Centre Category">
    <main class="centres-categories-create-blade main-content-div">
        <x-centre-tab />

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="card shadow-lg">
                        <div class="card-header text-center bg-white">
                            <h2><span>Add Centre category</span></h2>

                            @session('message') <p class="notification n-success">{{ session('message') }}</p> @endsession
                        </div>

                        <div class="card-body px-5">
                            <form action="{{ route('centre-categories.store') }}" method="post" enctype="multipart/form-data">

                                @csrf
                                <div class="form-group mt-3">
                                    <label class="form-label">Enter Name</label>
                                    <input type="text" value="{{ old('name') }}" placeholder="Category Name" name="name" class="form-control" id="name" />
                                     @error('name') <p class="text-danger mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="form-group mt-3">
                                    <button type="submit" class="submit-green btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>