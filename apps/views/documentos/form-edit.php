<form action="/save" method="post">
    <div class="card-body">
        <div class="row">
            <div class="form-group">
        <label for="id">Id</label>
        <select name="id">	
    <option selected="selected">---</option>	
    <option value="0">Não</option>	
    <option value="1">Sim</option>
</select>
    </div>    <div class="form-group">
        <label for="id_type">Id_type</label>
        <select name="id_type">	
    <option selected="selected">---</option>	
    <option value="0">Não</option>	
    <option value="1">Sim</option>
</select>
    </div>    <div class="form-group">
        <label for="class_id">Class_id</label>
        <select name="class_id">	
    <option selected="selected">---</option>	
    <option value="0">Não</option>	
    <option value="1">Sim</option>
</select>
    </div>    <div class="form-group">
        <label for="subject">Subject</label>
        <input type="text" name="subject" id="subject" class="form-control" autocomplete="off">
    </div>    <div class="form-group">
        <label for="number">Number</label>
        <input type="text" name="number" id="number" class="form-control" autocomplete="off">
    </div>    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" autocomplete="off">
    </div>    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" id="content" rows="30" class="form-control"></textarea>
    </div>    <div class="form-group">
        <label for="sector_id">Sector_id</label>
        <select name="sector_id">	
    <option selected="selected">---</option>	
    <option value="0">Não</option>	
    <option value="1">Sim</option>
</select>
    </div>    <div class="form-group">
        <label for="process_id">Process_id</label>
        <select name="process_id">	
    <option selected="selected">---</option>	
    <option value="0">Não</option>	
    <option value="1">Sim</option>
</select>
    </div>    <div class="form-group">
        <label for="status">Status</label>
        <input type="text" name="status" id="status" class="form-control" autocomplete="off">
    </div>    <div class="form-group">
        <label for="created_by">Created_by</label>
        <select name="created_by">	
    <option selected="selected">---</option>	
    <option value="0">Não</option>	
    <option value="1">Sim</option>
</select>
    </div>    <div class="form-group">
        <label for="requested_review_by">Requested_review_by</label>
        <select name="requested_review_by">	
    <option selected="selected">---</option>	
    <option value="0">Não</option>	
    <option value="1">Sim</option>
</select>
    </div>    <div class="form-group">
        <label for="requested_review_at">Requested_review_at</label>
        <input type="text" name="requested_review_at" id="requested_review_at" class="form-control" autocomplete="off">
    </div>    <div class="form-group">
        <label for="created_at">Created_at</label>
        <input type="text" name="created_at" id="created_at" class="form-control" autocomplete="off">
    </div>    <div class="form-group">
        <label for="updated_at">Updated_at</label>
        <input type="text" name="updated_at" id="updated_at" class="form-control" autocomplete="off">
    </div>
        </div>
         <div class="col-6">
            <button type="submit" class="btn btn-success">Salvar</button>
            <button class="btn btn-primary" type="button" id="cancelButton">Cancelar</button>
        </div>
    </div>
</form>