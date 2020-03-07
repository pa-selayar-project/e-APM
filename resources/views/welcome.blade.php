<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>e APM</title>

    <!-- Fonts -->
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="{{url('assets/images/favicon.png')}}">
    <link rel="stylesheet" href="{{url('assets/plugins/morris/morris.css')}}">
    <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/css/core.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/css/components.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/css/pages.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/css/menu.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/css/responsive.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{url('assets/js/modernizr.min.js')}}"></script>
    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif
    </div>

    <div class="content m-t-40 p-t-10">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box table-responsive">
                        <h1 class="text-center">LKE APM</h1>
                        <table id="lke1" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width:5%">No</th>
                                    <th style="width:20%">Area </th>
                                    <th style="width:20%">Kriteria</th>
                                    <th style="width:45%">Panduan Eviden</th>
                                    <th style="width:10%">Upload Dokumen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$data)
                                <tr>
                                    <td height="300px" colspan="5">
                                        <h1 class="text-center text-muted m-t-40">Tidak ada Data</h1>
                                    </td>
                                </tr>
                                @endif

                                @foreach($data as $d)
                                <tr>
                                    <td>{{$loop->iteration + $data->perPage() * ($data->currentPage() - 1)}}</td>
                                    <td>{{$d->area}}</td>
                                    <td>{{$d->kriteria}}</td>
                                    <td colspan="2">
                                        <table class="table table-striped" width="100%">
                                            <?php $eviden = \App\Eviden::where('nomor_urut', $d->nomor)->get(); ?>
                                            @foreach($eviden as $e)
                                            <tr>
                                                <td style="width:5%" valign="top">
                                                    {{$loop->iteration}}
                                                </td>
                                                <td style="width:78%" class="text-left" valign="top">
                                                    {{$e->nama_eviden}}
                                                </td>
                                                <td class="text-center" style="width:17%" valign="top">
                                                    @if($e->file_upload)
                                                    <a href=# class="text-danger download" data-id="{{$e->id}}" data-file="{{asset('assets/pdf')}}/{{$e->file_upload}}" data-target="#lihat" data-toggle="modal" title="Upload"><i class="fa  fa-file-pdf-o fa-lg"></i></a>
                                                    @else
                                                    <a href=# class="text-secondary upload" data-toggle="modal" data-id="{{$e->id}}" data-target="#tambah" title="Upload"><i class="fa  fa-file-pdf-o fa-lg"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5">
                                        {{ $data->links() }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- //-------modal Download--------- -->
    <div id="lihat" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        x
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <embed src="#" height="450px" width="700px">
                    </center>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="{{url('assets/js/jquery.min.js')}}"></script>
    <script src="{{url('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{url('assets/js/detect.js')}}"></script>
    <script src="{{url('assets/js/fastclick.js')}}"></script>

    <script src="{{url('assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{url('assets/js/jquery.blockUI.js')}}"></script>
    <script src="{{url('assets/js/waves.js')}}"></script>
    <script src="{{url('assets/js/wow.min.js')}}"></script>
    <script src="{{url('assets/js/jquery.nicescroll.js')}}"></script>
    <script src="{{url('assets/js/jquery.scrollTo.min.js')}}"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#lke1').DataTable();
        });
        $('.download').on('click', function() {
            const file = $(this).data('file'),
                id = $(this).data('id');
            $('embed').attr('src', file);
        });
    </script>
</body>

</html>