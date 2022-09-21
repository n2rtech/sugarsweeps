@if (count($errors) > 0)
    <div class="alert alert-danger" style="padding: 0;">
        <ul class="list-group" style="list-style: none;">
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif