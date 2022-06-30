<x-templates.default>
    <x-slot:pretitle>Data Publisher</x-slot:pretitle>
    <x-slot:title>Publishers</x-slot:title>
    <x-slot:page_action>
        <a href="{{ route('publishers.create') }}" class="btn btn-primary">Add Publisher</a>
        <a href="{{ route('publishers.export-excel') }}" class="btn btn-success">Export Excel</a>
    </x-slot:page_action>
    <x-slot:extraStyles>
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.18/sweetalert2.min.css" integrity="sha512-CJ5goVzT/8VLx0FE2KJwDxA7C6gVMkIGKDx31a84D7P4V3lOVJlGUhC2mEqmMHOFotYv4O0nqAOD0sEzsaLMBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </x-slot:extraStyles>
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot:extraScripts>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

        <script>
            $(function() {
                $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('publishers.index') !!}', // memanggil route yang menampilkan data json
                    columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'slug',
                            name: 'slug'
                        },
                        {
                            data: 'address',
                            name: 'address'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        }
                    ]
                });
            });
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.18/sweetalert2.min.js" integrity="sha512-98hK38IvWQC069FFbq/la6NaBj4TGplZ118B+bFVOxsBQQL4EqKUWw9JkNh8Lem7FCGkLCxgr81q+/hRIemJCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $('#dataTable').on('click', 'button#delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Kamu yakin hapus data ini?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok, Delete!',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: 'DELETE',
                            url: '/publishers/' + id,
                            data: {
                                'id': id,
                                '_token': "{{ csrf_token() }}"
                            },
                           success: function(response) {
                                if (response.error) {
                                    Swal.fire(
                                        'Gagal menghapus data!',
                                        response.error,
                                        'error'
                                    )
                                } else {
                                    Swal.fire(
                                        'Dihapus!',
                                        'Data berhasil dihapus.',
                                        'success'
                                    )

                                    location.reload(true);
                                }
                            },
                        });
                    }
                })
            })
        </script>

    </x-slot:extraScripts>
</x-templates.default>
