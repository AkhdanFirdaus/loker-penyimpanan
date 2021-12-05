<?php
include_once 'model/loker_model.php';

$model = new LokerModel();

if (isset($_POST['form_loker'])) {
    $tipe = $_POST['tipe'];

    $nama_loker = $_POST['nama_loker'];
    $kapasitas_loker = $_POST['kapasitas_loker'];

    if ($tipe == 'edit_loker') {
        $id_loker = $_POST['id_loker'];
        $model->updateLoker($id_loker, $nama_loker, $kapasitas_loker);
    } else {
        $model->insertLoker($nama_loker, $kapasitas_loker);
    }
}

if (isset($_GET['message'])) {
    $message = $_GET['message'];
}

if (isset($_GET['errormessage'])) {
    $errormessage = $_GET['errormessage'];
}

$id_loker = '';
$nama_loker = '';
$kapasitas_loker = '';

if (isset($_GET['tipe'])) {
    $id_loker = $_GET['id_loker'];
    $nama_loker = $_GET['nama_loker'];
    $kapasitas_loker = $_GET['kapasitas_loker'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-indigo-100">
    <div class="container mx-auto h-screen flex flex-col justify-center items-center">
        <?php if (!empty($message)) : ?>
            <div class="bg-green-300 text-white mb-5 rounded px-4 py-2 shadow-md hover:bg-green-500">
                <p class="text-center font-bold"><?= $message ?></p>
            </div>
        <?php endif; ?>
        <?php if (!empty($errormessage)) : ?>
            <div class="absolute bottom-0 md:w-full left-0 right-0 px-4 alert-message">
                <div class="bg-red-500 text-white mb-5 rounded px-4 py-2 shadow-md hover:bg-green-500 flex flex-wrap items-center justify-between">
                    <p class="text-center font-bold"><?= $errormessage ?></p>
                    <span class="cursor-pointer alert-message-button"><i class="fas fa-close"></i></span>
                </div>
            </div>
        <?php endif; ?>
        <div class="border-2 border-opacity-50 border-indigo-500 hover:bg-white hover:shadow-lg hover:border-transparent text-indigo-500 hover:text-gray-900 duration-100 rounded p-5 group">
            <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" class="space-y-4">
                <input type="hidden" name="tipe" value="value=" <?= $id_loker == NULL ? 'tambah_loker' : 'edit_loker' ?>>
                <input type="hidden" name="id_loker" value="<?= $id_loker ?>">
                <div class="flex space-x-2 items-center">
                    <a href="index.php"><i class="fas fa-arrow-left"></i></a>
                    <h1 class="text-xl font-bold"><?= $id_loker == NULL ? 'Tambah Loker' : 'Edit Loker' ?></h1>
                </div>
                <hr class="border-indigo-500 group-hover:border-gray-900">
                <div class="space-y-2">
                    <label for="" class="block">Nama Loker</label>
                    <input type="text" name="nama_loker" value="<?= $nama_loker ?>" class="block px-4 py-3 rounded border-2 bg-transparent group-hover:border-white border-indigo-500 group-hover:border-gray-100">
                </div>
                <div class="space-y-2">
                    <label for="" class="block">Kapasitas</label>
                    <input type="number" name="kapasitas_loker" value="<?= $kapasitas_loker ?>" class="block px-4 py-3 rounded border-2 bg-transparent group-hover:border-white border-indigo-500 group-hover:border-gray-100">
                </div>
                <div class="flex justify-end space-x-2">
                    <button class="group-hover:text-white group-hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-opacity-50 px-4 py-2 font-semibold rounded-lg group-hover:shadow-md" type="reset">
                        Reset
                    </button>
                    <button name="form_loker" class="group-hover:text-white group-hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50 px-4 py-2 font-semibold rounded-lg group-hover:shadow-md" type="submit" name="submit">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>