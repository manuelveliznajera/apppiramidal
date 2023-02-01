@extends('../layout/side-menu')

@section('subhead')
    <title>CRUD Form - Midone - Tailwind HTML Admin Template</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://cdn.tailwindcss.com"></script>

@endsection

@section('subcontent')
    <div class="intro-y flex  flex-row-reverse mb-5 mt-3">
        <button class="btn btn-primary " data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" type="button">Add Product</button>
    </div>
    <div class="card">
        <div class="card-body">

            <livewire:productdatatble
            model="App\Models\Product"
            searchable="name"
            sort="name"
            exportable
           
            />

        </div>
    </div>
    <div class="modales">
        <div class="text-center">
            <a href="javascript:;" data-toggle="modal" data-target="#basic-modal" class="btn btn-primary">Show Modal</a>
        </div>
        <!-- END: Modal Toggle -->
        <!-- BEGIN: Modal Content -->
        <div id="basic-modal" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-10 text-center"> This is totally awesome blank modal! </div>
                </div>
            </div>
        </div>
  
    </div>
@endsection

@section('script')

@livewireScripts
<script>
    const el = document.querySelector("#basic-modal");
const modal = tailwind.Modal.getOrCreateInstance(el);
modal.show();
</script>
   


@endsection
