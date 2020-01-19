# Software requirements

1. [git](https://git-scm.com/)

2. [composer](https://getcomposer.org/)

3. [php >= 7.0](http://php.net)

# Install

In `htdocs` folder run some commands:

    git clone ssh://git@gitlab.hoidap.vn:2012/vnpf-starter/view.git [project_name]
    cd [project_name]
    git clone ssh://git@gitlab.hoidap.vn:2012/vnpf-starter/app.git

    // Remove .git folder
    rm -rf .git
    rm -rf app/.git

    composer install
    cd app/admin
    composer install

    // Publish Admin For Linux
    ln -s [project_path]/app/admin [project_path]/public/admin

    // Publish Admin For window
    mklink /J [project_path]\public\admin [project_path]\app\admin

# Install notes

    [project_name]: Tên folder dự án
    [project_path]: Đường dẫn tuyệt đối của dự án

# Get started

    cp .env.sample .env

    // Thay đổi các thông tin trong .env cho phù hợp với từng dự án
    // Tạo virtualhost trỏ đến `[project_path]/public`

# Đưa source lên gitlab, github, bitbucket....

Thực hiện bước này nếu bạn muốn đưa mã nguồn của bạn lên mạng để tránh dữ liệu bị mất khi hỏng máy tính hoặc các sự cố ngoài mong muốn hoặc muốn chia sẻ mã nguồn với người khác.

Trước khi thực hiện bước này bạn phải có một số kiến thức về sử dụng `git` và các trang quản lý mã nguồn hỗ trợ `git`

### Bước 1: Tạo 1 repository trên một trong các hệ thống trên
### Bước 2:

    cd [project_path]
    git remote add origin http://***.git hoặc ssh://***.git
    git add .
    git commmit -m 'first commit'
    git push -u origin master