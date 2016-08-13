<nav class="navbar navbar-light navbar-full bg-faded" style="border-bottom: 1px solid #1D2127; background-color: #39444b;position: static;color: white">
    <ul class="nav navbar-nav">
        <li class="nav-item">
            <button class="btn btn-primary" data-toggle="modal" data-target="#createNote">Create Note</button>
        </li>
        <li class="nav-item">
            <div class="checkbox abc-checkbox checkbox-primary" style="padding-top: .425rem">
                {!! Form::checkbox('share_checkbox','true',Auth::user()->include_shares,['v-model'=>'include_share','v-on:change'=>'includeShares','class'=>'styled','id'=>'share_checkbox']) !!}
                <label for="share_checkbox">
                    Include Shares
                </label>
            </div>
        </li>
        <li class="nav-item">
            <div class="btn btn-danger animated loading" role="alert" transition="restore-alert" v-show="restore" v-on:click="restoreDeletedNote">
                <i class="fa fa-undo"></i> Restore Deleted Note
            </div>
        </li>
    </ul>
    <div class="pull-xs-right text-xs-center" style="width: 40px;padding-top: 3px;padding-left: 10px;">
        <i class="fa fa-refresh fa-spin fa-2x fa-fw" v-show="loading"></i>
    </div>
    <div class="form-inline pull-xs-right">
        <input class="form-control" v-model="search" type="text" placeholder="Filter">
    </div>
</nav>