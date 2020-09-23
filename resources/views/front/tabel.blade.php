<tbody>
@foreach($asses as $d)
  <tr>
    <td>{{$loop->iteration + $asses->perPage() * ($asses->currentPage() - 1)}}</td>
    <td>{{$d->area}}</td>
    <td>{{$d->kriteria}}</td>
    <td colspan="2">
      <table class="table table-striped table-responsive" width="100%">
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
              <a href=# class="text-danger download" data-id="{{$e->id}}" data-file="{{asset('assets/pdf')}}/{{$e->file_upload}}" data-target="#lihat" data-toggle="modal" title="Klik untuk lihat file"><i class="fa fa-file-pdf-o fa-lg"></i></a>
            @else
              <a href=# class="text-secondary" title="Belum ada File"><i class="fa fa-file-pdf-o fa-lg"></i></a>
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
    {{$asses->links()}}
    </td>
  </tr>
</tfoot>

