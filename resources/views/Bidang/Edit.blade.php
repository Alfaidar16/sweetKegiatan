
<div class="modal fade" id="EditJenisInformasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Edit data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body">
        
    <form action="{{ route('bidang.update', $v->id) }}" enctype="multipart/form-data"  method="post" accept-charset="utf-8">
    @csrf
    @method('PUT')
    <input type="hidden" name="id"   value="{{ $v->id }}">
    
    <div class="form-group row">
        <select class="form-select" aria-label="Default select example">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
    </div>
    {{-- <div class="form-group row">
        <label class="col-md-3"><span>Type Ini Jenis Dalam Informasi</span></label>
        <div class="col-md-9">
            <input type="text" name="type" class="form-control" placeholder="Type"  required value="{{ $v->type }}">
        </div>
    </div> --}}
  
    
   
    
    
    <div class="form-group row">
        <label class="col-md-3"></label>
        <div class="col-md-9">
    <div class="btn-group">
    <input type="submit" name="submit" class="btn btn-success " value="Simpan Data">
    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
    </div>
    </div>
    </div>
    
    <div class="clearfix"></div>
    
    </form>
    
    </div>
    </div>
    </div>
    </div>
    