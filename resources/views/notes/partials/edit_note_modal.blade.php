<div class="modal fade" id="editNote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{ Form::open(['v-on:submit.prevent'=>'submitEditNote']) }}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil text-info"></i> Edit
                    Note</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="noteTitle">Title</label>
                    {{ Form::text('title',null,['class'=>'form-control','id'=>'noteTitle','placeholder'=>'Title','v-model'=>'edit_note.title','maxlength'=>50]) }}
                </div>
                <div class="form-group">
                    <label for="noteDescription">Description</label>
                    {{ Form::textarea('description',null,['class'=>'form-control','id'=>'noteDescription','placeholder'=>'Description','v-model'=>'edit_note.description','maxlength'=>250]) }}
                </div>
                <div class="form-group">
                    <label for="noteDescription">Color</label>
                    {{ Form::select('color_id',Auth::user()->note_colors()->lists('display_name','id'),null,['class'=>'form-control','id'=>'noteDescription','placeholder'=>'No Color','v-model'=>'edit_note.color_id']) }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>