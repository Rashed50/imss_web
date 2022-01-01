<div class="row">
    <div class="col-md-5">
        <div class="form-group row">
            <label for="inputDate" class="col-sm-5 col-form-label">Starting Date</label>
            <div class="col-sm-7">
            <input type="date" name="fromDate" value="{{ @$fromDate ?? date('Y-m-d') }}" class="form-control" id="inputDate">
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="form-group row">
            <label for="inputDate" class="col-sm-5 col-form-label">Ending Date</label>
            <div class="col-sm-7">
           
            <input type="date" name="toDate" value="{{ @$toDate ?? date('Y-m-d') }}" class="form-control" id="inputDate">
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-outline-success">SEARCH</button>
    </div>
</div>