# ระบบบันทึกรายรับรายจ่าย (Expense Tracker)

ระบบจัดการรายรับรายจ่ายส่วนบุคคลที่พัฒนาด้วย Laravel Framework สำหรับช่วยในการติดตามและควบคุมการเงินส่วนตัว


## ตัวอย่างหน้าจอ

> **หมายเหตุ**: รูปภาพตัวอย่างทั้งหมดควรถูกวางในโฟลเดอร์ `docs/images/` หรือ `screenshots/` ของโปรเจค

### 1. หน้าแสดงรายการหลัก
<img width="1736" height="966" alt="Screenshot 2025-08-24 212657" src="https://github.com/user-attachments/assets/203484b0-b5ea-4b1a-bf3c-70a889659c64" />



### 2. ฟอร์มเพิ่มรายการใหม่
<img width="1493" height="760" alt="Screenshot 2025-08-24 212720" src="https://github.com/user-attachments/assets/50d1d798-d040-4c41-8c08-195c6ba5958d" />



### 3. ฟอร์มแก้ไขรายการ
<img width="1334" height="760" alt="Screenshot 2025-08-24 212733" src="https://github.com/user-attachments/assets/b7a7b003-9f79-46b3-b2f3-68af42d54798" />



### 4. การยืนยันการลบ
<img width="1806" height="983" alt="Screenshot 2025-08-24 212750" src="https://github.com/user-attachments/assets/dc7cb653-c5aa-4aad-b4e6-48b996c7a4be" />

### 4. UX/UI Design 
<img width="1546" height="819" alt="Screenshot 2025-08-24 213928" src="https://github.com/user-attachments/assets/adb20b30-9ce0-4e64-aba4-1d8d5d50d6c4" />
<img width="1458" height="831" alt="Screenshot 2025-08-24 213934" src="https://github.com/user-attachments/assets/43395b05-a396-4ade-9483-ca90d811d919" />
<img width="1450" height="809" alt="Screenshot 2025-08-24 214214" src="https://github.com/user-attachments/assets/62e61c93-ec99-4e46-9d40-791381e3ced5" />





## เทคโนโลยีที่ใช้

- **Framework**: Laravel 10.x
- **Frontend**: Bootstrap 5.3, Font Awesome 6.0
- **Database**: MySQL
- **Language**: PHP 8.1+
- **CSS Framework**: Bootstrap 5


### ขั้นตอนการติดตั้ง

1. **Clone repository**
   ```bash
   git clone https://github.com/yourusername/expense-tracker.git
   cd expense-tracker
   ```

2. **ติดตั้ง dependencies**
   ```bash
   composer install
   npm install
   npm run build
   ```

3. **ตั้งค่า environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **แก้ไขไฟล์ .env**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=expense_tracker
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

5. **สร้างฐานข้อมูล**
   ```bash
   php artisan migrate
   ```

6. **เริ่มเซิร์ฟเวอร์**
   ```bash
   php artisan serve
   ```



## 🗄โครงสร้างฐานข้อมูล

### ตาราง `transactions`
| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| type | enum('income','expense') | ประเภทรายการ |
| description | varchar(255) | รายละเอียดรายการ |
| amount | decimal(10,2) | จำนวนเงิน |
| transaction_date | date | วันที่ทำรายการ |
| created_at | timestamp | วันที่สร้าง |
| updated_at | timestamp | วันที่แก้ไขล่าสุด |

