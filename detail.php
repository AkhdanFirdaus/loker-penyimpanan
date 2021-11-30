<?php
include_once 'model/loker_model.php';
include_once 'model/barang_model.php';

$lokerModel = new LokerModel();

if (isset($_GET['message'])) {
    $message = $_GET['message'];
}

if (isset($_GET['errormessage'])) {
    $errormessage = $_GET['errormessage'];
}

$idLoker = $_GET['id'];

$loker = $lokerModel->showLoker($idLoker);

$barangModel = new BarangModel($idLoker);
$listBarang = $barangModel->readBarang();

if (isset($_POST['submit'])) {
    $tipe = $_POST['tipe'];

    if ($tipe == 'tambah_barang') {
        $nama = $_POST['nama_barang'];
        $qty = $_POST['qty_barang'];
        $barangModel->insertBarang($nama, $qty);
    } else if ($tipe == 'edit_barang') {
        $id = $_POST['id_barang'];
        $nama = $_POST['nama_barang'];
        $qty = $_POST['qty_barang'];
        $barangModel->updateBarang($id, $nama, $qty);
    } else if ($tipe == 'hapus_barang') {
        $id = $_POST['id_barang'];
        $barangModel->deleteBarang($id);
    }
}

if (isset($_POST['hapus_loker'])) {
    $id_loker = $_POST['id_loker'];
    $lokerModel->deleteLoker($id_loker);
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
    <div class="container mx-auto md:w-3/4 h-screen flex justify-center items-center">
        <div class="w-full p-5">
            <div class="flex items-center mb-3 space-x-5">
                <a href="index.php"><i class="fas fa-arrow-left"></i></a>
                <h1 class="text-3xl flex-grow">Lihat Loker</h1>
                <div class="flex items-center bg-white shadow">
                    <label class="font-bold px-3"><?= $loker['nama_loker'] ?></label>
                    <label class="px-3">Kapasitas: <span class="font-semibold text-lg"><?= $loker['kapasitas_loker'] ?></span></label>
                    <form action="tambah.php" method="GET" name="edit_loker" class="bg-indigo-500 py-2 px-3 hover:bg-indigo-700">
                        <input type="hidden" name="tipe" value="edit_loker">
                        <input type="hidden" name="id_loker" value="<?= $loker['id_loker'] ?>">
                        <input type="hidden" name="nama_loker" value="<?= $loker['nama_loker'] ?>">
                        <input type="hidden" name="kapasitas_loker" value="<?= $loker['kapasitas_loker'] ?>">
                        <button type="submit" class="text-white"><i class="fas fa-edit"></i> Edit Loker</button>
                    </form>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="bg-red-500 py-2 px-3 hover:bg-red-700">
                        <input type="hidden" name="tipe" value="hapus_loker">
                        <input type="hidden" name="id_loker" value="<?= $loker['id_loker'] ?>">
                        <button name="hapus_loker" type="submit" class="text-white"><i class="fas fa-edit"></i> Hapus Loker</button>
                    </form>
                </div>
            </div>
            <div class="flex flex-grow md:flex-row flex-col">
                <div class="relative flex-grow border-2 border-opacity-50 border-indigo-500 hover:bg-white hover:shadow-lg hover:border-transparent text-indigo-500 hover:text-gray-900 duration-100 rounded p-5">
                    <?php if (!empty($message)) : ?>
                        <div class="absolute bottom-0 md:w-full left-0 right-0 px-4 alert-message">
                            <div class="bg-green-300 text-white mb-5 rounded px-4 py-2 shadow-md hover:bg-green-500 flex flex-wrap items-center justify-between">
                                <p class="text-center font-bold"><?= $message ?></p>
                                <span class="cursor-pointer alert-message-button"><i class="fas fa-close"></i></span>
                            </div>
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
                    <table class="table-auto border w-full">
                        <thead>
                            <tr>
                                <th class="px-2 py-1 border border-indigo-500">#</th>
                                <th class="px-2 py-1 border border-indigo-500">Name</th>
                                <th class="px-2 py-1 border border-indigo-500">Quantity</th>
                                <th class="px-2 py-1 border border-indigo-500">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($listBarang) > 0) : ?>
                                <?php
                                $index = 1;
                                foreach ($listBarang as $barang) :
                                ?>
                                    <tr class="hover:bg-indigo-500 hover:text-white">
                                        <td class="px-2 py-1 border border-indigo-500"><?= $index++ ?></td>
                                        <td class="px-2 py-1 border border-indigo-500"><?= $barang['nama_barang'] ?></td>
                                        <td class="px-2 py-1 border border-indigo-500"><?= $barang['qty_barang'] ?></td>
                                        <td class="px-2 py-1 border border-indigo-500">
                                            <div class="flex justify-around items-center">
                                                <button onclick="edit('<?= $barang['id_barang'] ?>', '<?= $barang['nama_barang'] ?>', '<?= $barang['qty_barang'] ?>')" class="hover:text-yellow"><i class="fas fa-edit"></i></button>
                                                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>?id=<?= $idLoker ?>">
                                                    <input type="hidden" name="tipe" value="hapus_barang">
                                                    <input type="hidden" name="id_barang" value="<?= $barang['id_barang'] ?>">
                                                    <button type="submit" name="submit" class="hover:text-red"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr class="hover:bg-indigo-500 hover:text-white">
                                    <td colspan="4" class="px-2 py-1 border border-indigo-500 text-center">Tidak ada barang</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="w-2 h-2"></div>
                <div class="flex-2">
                    <div class="border-2 border-opacity-50 border-indigo-500 hover:bg-white hover:shadow-lg hover:border-transparent text-indigo-500 hover:text-gray-900 duration-100 rounded p-5 group">
                        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>?id=<?= $idLoker ?>" class="space-y-4">
                            <div class="flex space-x-2 items-center">
                                <h1 class="text-xl font-bold">Tambah Barang</h1>
                            </div>
                            <hr class="border-indigo-500 group-hover:border-gray-900">
                            <div class="invisible block space-y-2">
                                <input type="hidden" name="tipe" id="tipe_aksi" value="tambah_barang">
                                <input type="hidden" name="id_barang" id="id_barang">
                            </div>
                            <div class="block space-y-2">
                                <label for="nama_barang" class="block">Nama Barang</label>
                                <input type="text" name="nama_barang" id="nama_barang" class="w-full px-4 py-3 rounded border-2 bg-transparent group-hover:border-white border-indigo-500 group-hover:border-gray-100">
                            </div>
                            <div class="block space-y-2">
                                <label for="qty_barang" class="block">Quantity</label>
                                <input type="number" name="qty_barang" id="qty_barang" class="w-full px-4 py-3 rounded border-2 bg-transparent group-hover:border-white border-indigo-500 group-hover:border-gray-100">
                            </div>
                            <div class="flex justify-end space-x-2">
                                <button id="reset" class="group-hover:text-white group-hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-opacity-50 px-4 py-2 font-semibold rounded-lg group-hover:shadow-md" type="reset">
                                    Reset
                                </button>
                                <button id="kirim" name="submit" class="group-hover:text-white group-hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50 px-4 py-2 font-semibold rounded-lg group-hover:shadow-md">
                                    Tambah Barang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let alertButton = document.querySelector('.alert-message-button')
        if (alertButton) {
            alertButton.addEventListener('click', () => {
                document.querySelector('.alert-message').remove()
            })
        }

        function edit(id, nama, qty) {
            document.getElementById('tipe_aksi').value = 'edit_barang'
            document.getElementById('id_barang').value = id
            document.getElementById('nama_barang').value = nama
            document.getElementById('qty_barang').value = qty
            document.getElementById('kirim').innerText = 'Edit Barng'
        }

        document.getElementById('reset').addEventListener('click', () => {
            document.getElementsByClassName('tipe').value = 'tambah_barang'
            document.getElementById('kirim').innerText = 'Tambah Barang'
        })
    </script>
</body>

</html>