<div class="modal fade" id="shareNote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="pull-xs-right text-xs-center" style="width: 40px;padding-top: 3px;padding-left: 10px;">
                    <i class="fa fa-refresh fa-spin fa-2x fa-fw" v-show="loading_shares"></i>
                </div>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-share-alt text-success"></i> Share
                    Note</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-info m-b-0 text-xs-center" role="alert" v-show="!share_user_list.length">
                    This note is not shared with anyone
                </div>
                <ul class="list-group">
                    <li class="list-group-item animated" v-for="user in share_user_list" transition="share-user">
                        <div class="row">
                            <div class="col-xs-8">
                                <img v-bind:src="user.avatar_url" class="img-rounded"
                                     style="width: 20px;height: 20px;"
                                     alt="">
                                @{{ user.name }}
                            </div>
                            <div class="col-xs-3 text-xs-left">
                                <i class="fa fa-check-square text-success" v-show="user.pivot.modify" v-show="user"
                                   title="Can Modify"></i>
                                <i class="fa fa-minus-square text-danger" v-show="!user.pivot.modify" v-show="user"
                                   title="Can Not Modify"></i>
                            </div>
                            <div class="col-xs-1 text-xs-right">
                                <a href="#" v-on:click="deleteShareUser(user)"><i
                                            class="fa fa-close text-danger"></i></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <hr class="m-a-0">
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-10">
                        <input type="text" class="form-control" v-model="new_share.email" placeholder="User Email">
                        <div class="checkbox abc-checkbox checkbox-primary" style="padding-top: .425rem">
                            {!! Form::checkbox('allow_modify','true',null,['v-model'=>'new_share.modify','class'=>'styled','id'=>'allow_modify']) !!}
                            <label for="allow_modify">
                                Allow use to modify note
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <button class="btn btn-primary" v-on:click="addNewShare">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>