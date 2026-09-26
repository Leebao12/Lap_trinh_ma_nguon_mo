<?php
session_start();
class BankAccount{
    private string $soTK;
    private string $tenTK;
    private float $soDu;

    public function __construct($soTK,$tenTK,$soDu)
    {
        $this->soTK=$soTK;
        $this->tenTK=$tenTK;
        $this->soDu=$soDu;
    }
    public function naptien($sotien){
        if ($sotien>0) 
        {
            $this->soDu+=$sotien;
            return"Nạp tiền thành công!";
        }
        else 
            return"Qúy khách nạp tiền không hơp lệ!<br>";

    }
    public function ruttien($sotien){
        if($sotien>0 && $this->soDu>=$sotien)
            {
                $this->soDu-=$sotien;
                return "Qúy khách đã rút {$sotien}. Số dư còn lại là {$this->soDu} <br>";
            }
        else
            return "Qúy khách rút số tiền không hợp lệ!<br>";
    }
    public function hienthisodu()
    {
        return $this->soDu;
    }
    public function getSoTK()
    {
        return $this->soTK;
    }

    public function getTenTK()
    {
        return $this->tenTK;
    }
}
$soDu = $_SESSION["soDu"] ?? 2000;
$taikhoan= new BankAccount("0123456789","Lê Quang Bảo",$soDu);
$thongbao = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sotien = (float) $_POST["sotien"];

    if (isset($_POST["naptien"])) {
        $thongbao = $taikhoan->naptien($sotien);
    }

    if (isset($_POST["ruttien"])) {
        $thongbao = $taikhoan->ruttien($sotien);
    }
    $_SESSION["soDu"] = $taikhoan->hienthisodu();
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý tài khoản ngân hàng</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
        }

        .container {
            width: 500px;
            margin: 60px auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #2563eb;
            margin-bottom: 25px;
        }

        .info {
            background: #eff6ff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .info p {
            margin: 8px 0;
        }

        .balance {
            color: #16a34a;
            font-size: 22px;
            font-weight: bold;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .buttons {
            display: flex;
            gap: 10px;
        }

        button {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-nap {
            background: #16a34a;
        }

        .btn-rut {
            background: #dc2626;
        }

        button:hover {
            opacity: 0.85;
        }

        .message {
            margin-top: 20px;
            padding: 12px;
            background: #fef3c7;
            border-radius: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <h1>🏦 Tài khoản ngân hàng</h1>
        <div class="info">
            <p>
                <strong>Số tài khoản:</strong>
                <?= $taikhoan->getSoTK(); ?>
            </p>
            <p>
                <strong>Chủ tài khoản:</strong>
                <?= $taikhoan->getTenTK(); ?>
            </p>
            <p>
                <strong>Số dư:</strong>
                <span class="balance">
                    <?= number_format($taikhoan->hienthisodu()); ?> VNĐ
                </span>
            </p>
        </div>
        <form method="POST">
            <label>Nhập số tiền:</label>
            <input
                type="number"
                name="sotien"
                placeholder="Nhập số tiền..."
                min="0"
                required
            >
            <div class="buttons">
                <button
                    type="submit"
                    name="naptien"
                    class="btn-nap"
                >
                    💰 Nạp tiền
                </button>
                <button
                    type="submit"
                    name="ruttien"
                    class="btn-rut"
                >
                    💸 Rút tiền
                </button>
            </div>
        </form>
        <?php if ($thongbao != ""): ?>
            <div class="message">
                <?= $thongbao; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>