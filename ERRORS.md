# Nhật ký Lỗi hệ thống (ERRORS.md)

Mọi lỗi phát sinh trong quá trình xây dựng, kiểm thử và vận hành hệ thống được ghi lại tại đây để phục vụ cho việc học tập và cải tiến liên tục.

---

## [2026-05-21 18:35] - Lỗi Static Code Analysis (PHPCS) trên GitHub Actions Pipeline

- **Type**: Process & Test Failure (PHPCS Violations)
- **Severity**: High
- **File**: `.github/workflows/ci.yml` (bước tạo file `wp-content/themes/my-theme/functions.php`)
- **Agent**: Sunless
- **Root Cause**: Tệp tin `functions.php` mẫu được tạo tự động trong pipeline vi phạm nghiêm trọng các quy tắc định dạng code của chuẩn PSR2 (thiếu dấu ngoặc xuống dòng cho hàm, có khoảng trắng dư thừa trong dấu ngoặc đơn của các lệnh gọi hàm, và chứa cả định nghĩa hàm lẫn side effect thực thi trực tiếp trong cùng một file). Do ta đã loại bỏ cờ `|| true`, pipeline bị dừng ngay lập tức (Exit code 3).
- **Error Message**:
  ```text
  FILE: wp-content/themes/my-theme/functions.php
  FOUND 7 ERRORS AND 1 WARNING AFFECTING 5 LINES
  8 | ERROR   | [x] Opening brace should be on a new line
  9 | ERROR   | [x] Space after opening parenthesis of function call prohibited
  9 | ERROR   | [x] Expected 0 spaces before closing parenthesis; 1 found
  ...
  Error: Process completed with exit code 3.
  ```
- **Fix Applied**: Thay thế mã nguồn của tệp `functions.php` mẫu bằng một định nghĩa Class OOP hoàn chỉnh (`ThemeSetup`) tuân thủ tuyệt đối 100% chuẩn PSR2, loại bỏ hoàn toàn các lỗi định dạng và warning side-effect.
- **Prevention**: Luôn kiểm tra định dạng code cục bộ trước khi push lên Git và không sử dụng side-effect trộn lẫn với khai báo ký hiệu trong các file mẫu.
- **Status**: Fixed

---
