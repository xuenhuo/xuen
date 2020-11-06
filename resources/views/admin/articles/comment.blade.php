<div class="modal fade" id="commentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="comment-title"></h4>
                <button type="button" class="close" data-dismiss="modal"><span >&times;</span></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>用户ID</th>
                            <th>内容</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="comment-list">
                        @foreach ($comments as $comment)
                            <tr id="comment{{ $comment->id }}">
                                <td>{{$comment->id}}</td>
                                <td>{{$comment->user_id}}</td>
                                <td>{{$comment->content}}</td>
                                <td>
                                    <button class="btn btn-danger cmdelete" value="{{$comment->id}}" data-url="{{route('admin.articles.comments.destroy', [$comment->article_id, $comment->id])}}">删除</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>