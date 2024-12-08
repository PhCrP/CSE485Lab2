<?php
// Hàm hiển thị cấu trúc thư mục
function displayDirectoryStructure($directory, $indent = 0) {
    // Kiểm tra xem có phải thư mục không
    if (is_dir($directory)) {
        // Mở thư mục
        if ($handle = opendir($directory)) {
            echo str_repeat("&nbsp;", $indent * 4) . "<b>Thư mục:</b> " . basename($directory) . "<br>";

            // Lặp qua từng tệp và thư mục
            while (false !== ($file = readdir($handle))) {
                // Bỏ qua các mục '.' và '..'
                if ($file != "." && $file != "..") {
                    $filePath = $directory . DIRECTORY_SEPARATOR . $file;

                    // Nếu là thư mục, gọi đệ quy
                    if (is_dir($filePath)) {
                        displayDirectoryStructure($filePath, $indent + 1);
                    } else {
                        // Hiển thị tệp
                        echo str_repeat("&nbsp;", ($indent + 1) * 4) . "Tệp: " . $file . "<br>";
                    }
                }
            }
            closedir($handle);
        }
    } else {
        echo "Không phải thư mục hợp lệ.";
    }
}

// Thư mục gốc cần hiển thị
$rootDirectory = "E:/CNW/CSE485La2"; // Hoặc thay bằng đường dẫn thư mục bạn muốn
displayDirectoryStructure($rootDirectory);
?>
