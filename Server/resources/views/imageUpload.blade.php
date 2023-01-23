<!DOCTYPE html>
<html>
<head>
    <title>subir imagen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="btn-volver">
        <a href="http://localhost:8090/html/perfilHumano.html"><button class="volver"><i class="fa fa-arrow-left"
              aria-hidden="true"></i>Atrás</button></a>
      </div>
      <div class="p-2 border rounded-3 contenedorRegistro">
        <h2 class="text-center mb-2">Subir Avatar</h2>
      </div>
<div class="container">

    <div class="panel panel-primary">

        <div class="panel-heading mt-5 text-center">
            <h2>Subir Avatar</h2>
        </div>

        <div class="panel-body mt-5">

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <img src="images/{{ Session::get('image') }}" class="mb-2" style="width:400px;height:200px;">
            @endif

            <form action="{{ route('images') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="inputImage">Select Image:</label>
                    <input
                        type="file"
                        name="image"
                        id="inputImage"
                        >
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>

            </form>
            {{-- <form action="{{ asset('/user/'.$user->id.'/avatar') }}"
                class="dropzone" id="my-awesome-dropzone">
                  {{ csrf_field() }}
            </form> --}}
        </div>
    </div>
</div>
</body>
</html>
