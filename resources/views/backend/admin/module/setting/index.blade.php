<x-master-admin site-title="{{ $siteTitle }}" page-title="{{ $pageTitle }}">


    <x-breadcrumb page-title="{{ $pageTitle }}" site-title="{{ $siteTitle }}"
        dashboard-route="{{ route('admin.dashboard') }}" />

    <div class="row gy-4">

        <div class="col-12">
            <x-alert-notify />
        </div>



        <div class="col-12 col-md-12 col-xl-12 col-xxl-12 d-flex">

            <div class="w-100">

                <div class="card">
                    <div class="card-body">

                        <h3 class="mb-4">Site Configuration</h3>

                        <form action="{{ route('admin.option.update') }}" method="POST">
                            @csrf
                            @method('patch')


                            @if(isset($options) && !empty($options) && count($options) > 0)

                                @foreach ( $options as $option )

                                <div class="form-group mb-3">
                                    <label for="name">{{ str_replace('_',' ',ucwords($option->name)); }}</label>
                                    <input type="text" name="{{ $option->name }}" id="name" value="{{ $option->value }}"
                                        class="form-control w-100" />
    
                                    @error('{{ $option->name }}')
                                    <div class="alert alert-danger p-2 mt-2">
                                        <small>
                                            <p class="mb-0">{{ $message }}</p>
                                        </small>
                                    </div>
                                    @enderror
                                </div>


                                @endforeach

                            @endif



                        
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100">Update Settings</button>
                            </div>

                        </form>



                    </div>

                </div>


            </div>


        </div>

    </div>


</x-master-admin>