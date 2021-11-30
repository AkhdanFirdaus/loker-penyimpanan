<?php
include_once 'model/loker_model.php';

$model = new LokerModel();
$listLoker = $model->readLoker();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loker</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-indigo-100">
    <div class="container mx-auto h-screen flex md:w-1/2 sm:w-full items-center">
        <div class="w-full p-5">
            <div class="flex justify-between items-center mb-3">
                <h1 class="text-3xl">Loker</h1>
                <span>Akhdan - Nurul - Audi</span>
            </div>
            <div class="flex flex-grow md:flex-row flex-col">
                <div class="flex-grow bg-indigo-400 rounded p-5">
                    <?php if (count($listLoker) > 0) : ?>
                        <div class="grid md:grid-cols-2 sm:grid-cols-1 gap-2">
                            <?php foreach ($listLoker as $index => $loker) : ?>
                                <a href="detail.php?id=<?= $loker['id_loker'] ?>" class="block group border-2 border-opacity-50 bg-indigo-100 hover:bg-white hover:shadow-lg hover:border-transparent duration-100 rounded p-5 space-y-2">
                                    <p class="text-sm text-indigo-600 group-hover:text-gray-500">Nama Loker</p>
                                    <p class="font-bold text-indigo-600 group-hover:text-gray-900"><?= $loker['nama_loker'] ?></p>
                                    <hr class="border-indigo-500 group-hover:border-gray-900">
                                    <p class="text-sm text-indigo-600 group-hover:text-gray-500">Kapasitas Loker</p>
                                    <p class="font-bold text-indigo-500 group-hover:text-gray-500"><?= $loker['kapasitas_loker'] ?></p>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <div class="flex group border-2 border-opacity-50 bg-indigo-100 hover:bg-white hover:shadow-lg hover:border-transparent duration-100 rounded p-5 justify-center items-center">
                            <h4 class="text-indigo-600 group-hover:text-gray-900">Tidak Ada Loker</h4>
                        </div>

                    <?php endif; ?>
                </div>
                <div class="w-2 h-2"></div>
                <div class="flex-1">
                    <a href="tambah.php" class="border-2 border-opacity-50 border-indigo-500 hover:bg-white hover:shadow-lg hover:border-transparent text-indigo-500 hover:text-gray-900 duration-100 rounded p-5 flex justify-center items-center h-full">
                        <i class="fas fa-add fa-2x"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>