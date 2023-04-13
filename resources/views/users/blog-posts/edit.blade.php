@extends('layouts.main')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.9.1/skins/ui/oxide/content.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.9.1/skins/ui/oxide/skin.min.css" />
<style>
    figure>img {
        width: 200px;
        height: 200px;
        margin: 10px;
        position: relative;
    }
</style>
@endsection
@section('content')
<section class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <form method="POST" action="{{ route('blog-posts.update') }}" enctype="multipart/form-data"
            class="tg-formtheme tg-formdashboard">
            @method('PUT')
            @csrf
            <input type="hidden" name="blog_post_id" value="{{ $blogPost->id }}">
            <fieldset>
                <div class="tg-postanad">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                        <div class="tg-dashboardbox">
                            <div class="tg-dashboardboxtitle">
                                <h2>Edit Post</h2>
                            </div>
                            <div class="tg-dashboardholder">
                                <div class="form-group">
                                    <input type="text" name="title" value="{{ $blogPost->title }}" class="form-control" placeholder="Title*" required>
                                </div>
                                <div class="form-group">
                                    <textarea id="content" class="form-control" name="content"
                                        placeholder="Enter article body content">{!! $blogPost->content !!}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="edit_post_image">Image:</label>
                                    <div class="d-flex flex-column align-items-start">
                                        <img id="post-image-preview" src="{{ asset($blogPost->image_path) }}" alt="{{ 'No Image' }}"
                                            onerror="this.style.display='none'" style="max-width: 100%;">
                                        <input type="file" id="edit_post_image" class="form-control-file" name="image">
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <input type="submit" class="tg-btn" style="background-color: #00cc67; border: none"
                                        value="Post Ad">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">

                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.9.1/tinymce.min.js"></script>

<script>
    // Initialize TinyMCE editor
    tinymce.init({
        selector: '#content',
        height: 500,
        plugins: 'link image code',
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | link image | code'
    });
</script>

<script>
    $(document).ready(function() {
        $('#edit_post_image').change(function() {
        // Get the selected file
        const file = this.files[0];
        console.log(file);
        // Create a new FileReader object
        const reader = new FileReader();

        // Set up the FileReader object to update the image preview when the file is loaded
        reader.onload = function(e) {
        $('#post-image-preview').attr('src', e.target.result);
        };

        // Read the selected file as a data URL
        reader.readAsDataURL(file);
        });
    });
</script>
@endsection
