<?php

namespace App\Livewire\Admin\Konfigurasi;

use App\Libraries\PclZip;
use App\Models\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class Website extends Component
{
    use WithFileUploads;
    public $tab = 'umum';
    public $theme, $default_color, $favicon, $logo_website, $default_image;
    public function saveTheme($color_default, $theme)
    {
        $config = Config::first();
        if ($config) {
            $config->theme_mode = $theme ?? $this->theme;
            $config->color_default = $color_default;
            $config->save();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Tema berhasil diubah',
                'refresh' => true,
            ]);
        } else {
            Config::create([
                'theme_mode' => $color_default
            ]);
        }
    }
    public function saveSEO($name_panel, $title_website, $description_website, $keyword_website, $meta_website, $footer_website, $path)
    {
        $config = Config::first();
        if ($config) {

            if (!Schema::hasColumn('configs', 'path')) {
                DB::statement("ALTER TABLE configs ADD COLUMN path VARCHAR(255) NULL AFTER sitemap");
            }
            $config->path = $path;
            $config->save();
            $config->name_panel = $name_panel;
            $config->title_website = $title_website;
            $config->description_website = $description_website;
            $config->keyword_website = $keyword_website;
            $config->meta_website = $meta_website;
            $config->footer_website = $footer_website;
            if ($this->logo_website) {
                $imageName = time() . '.' . $this->logo_website->extension();
                $tempPath = $this->logo_website->getRealPath();
                if ($config->path) {
                    $destinationPath = $config->path . '/assets/images/' . $imageName;
                } else {
                    $destinationPath = public_path('assets/images/' . $imageName);
                }
                if (File::copy($tempPath, $destinationPath)) {
                    File::delete($tempPath);
                    $config->url_logo = 'assets/images/' . $imageName;
                }
            }
            if ($this->favicon) {
                $imageName = time() . '.' . $this->favicon->extension();
                $tempPath = $this->favicon->getRealPath();
                if ($config->path) {
                    $destinationPath = $config->path . '/assets/images/' . $imageName;
                } else {
                    $destinationPath = public_path('assets/images/' . $imageName);
                }
                if (File::copy($tempPath, $destinationPath)) {
                    File::delete($tempPath);
                    $config->favicon = 'assets/images/' . $imageName;
                }
            }
            if ($this->default_image) {
                $imageName = time() . '.' . $this->default_image->extension();
                $tempPath = $this->default_image->getRealPath();
                if ($config->path) {
                    $destinationPath = $config->path . '/assets/images/' . $imageName;
                } else {
                    $destinationPath = public_path('assets/images/' . $imageName);
                }
                if (File::copy($tempPath, $destinationPath)) {
                    File::delete($tempPath);
                    $config->default_image = 'assets/images/' . $imageName;
                }
            }
            $config->save();
            $this->reset('logo_website', 'default_image');
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Konfigurasi berhasil diubah',
                'refresh' => true,
            ]);
        } else {
            Config::create([
                'name_panel' => $name_panel,
                'description_website' => $description_website,
                'keyword_website' => $keyword_website
            ]);
        }
    }
    public function saveCronjob($array)
    {
        $config = Config::first();
        if ($config) {
            $config->cronjob = json_encode($array);
            $config->save();
            $this->dispatch('swal:modal', ['type' => 'success', 'title' => 'Berhasil', 'text' => 'Cronjob berhasil diubah', 'refresh' => false,]);
        } else {
            Config::create([
                'cronjob' => json_encode($array),
            ]);
        }
    }
    public function checkupdate()
    {
        $config = Config::first();
        $decode = json_decode($config->version_source, true);
        $data = [
            'client_id' => $decode['client_id'],
            'version' => $decode['version'],
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sewapanel.vip/api/update-online',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));
        $response = curl_exec($curl);
        $response = json_decode($response);
        curl_close($curl);
        if ($response->status == true) {
            $data = [
                'client_id' => $decode['client_id'],
                'version' => $response->version,
                'last_update' => $response->last_update,
                'message' => $response->message,
            ];
            $config->version_source = json_encode($data);
            $zipUrl = $response->download;
            $zipFilename = date('d-m-Yhis') . '.zip';
            $storagePath = base_path();
            $zipFilePath = $storagePath . '/' . $zipFilename;
            if (file_put_contents($zipFilePath, file_get_contents($zipUrl))) {
                $archive = new PclZip($zipFilePath);
                $extract = $archive->extract(PCLZIP_OPT_PATH, $storagePath);
                if ($extract == 0) {
                    $this->dispatch('swal:modal', [
                        'type' => 'error',
                        'title' => 'Gagal',
                        'text' => 'Gagal mengupdate source code',
                    ]);
                } else {
                    $config->save();
                    unlink($zipFilePath);
                    $this->dispatch('swal:modal', [
                        'type' => 'success',
                        'title' => 'Berhasil',
                        'text' => 'Berhasil mengunduh dan mengekstrak file ZIP ke root project.',
                        'refresh' => true,
                    ]);
                }
            } else {
                $this->dispatch('swal:modal', [
                    'type' => 'error',
                    'title' => 'Gagal',
                    'text' => 'Gagal mengupdate source code',
                    'refresh' => false,
                ]);
            }
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Gagal mengupdate source code',
                'refresh' => false,
            ]);
        }
    }
    public function saveSMTP($send_mail, $mail_mailer,  $mail_host, $mail_port, $mail_username, $mail_password, $mail_encryption, $mail_from_address, $mail_from_name)
    {
        $config = Config::first();
        if ($config) {
            $decode = json_decode($config->konfigurasi_mail, true);
            $data = [
                'send_mail' => $send_mail,
                'mail_mailer' => $mail_mailer,
                'mail_host' => $mail_host,
                'mail_port' => $mail_port,
                'mail_username' => $mail_username,
                'mail_password' => $mail_password,
                'mail_encryption' => $mail_encryption,
                'mail_from_address' => $mail_from_address,
                'mail_from_name' => $mail_from_name,
            ];
            // ganti juga di .env nya
            if (strpos(file_get_contents(base_path('.env')), 'MAIL_MAILER="' . $decode['mail_mailer'] . '"') === false) {
                $this->dispatch('swal:modal', [
                    'type' => 'error',
                    'title' => 'Gagal',
                    'text' => 'Konfigurasi SMTP tidak ditemukan di file .env',
                ]);
            }
            $env = file_get_contents(base_path('.env'));
            $env = str_replace('MAIL_MAILER="' . $decode['mail_mailer'] . '"', 'MAIL_MAILER="' . $mail_mailer . '"', $env);
            $env = str_replace('MAIL_HOST="' . $decode['mail_host'] . '"', 'MAIL_HOST="' . $mail_host . '"', $env);
            $env = str_replace('MAIL_PORT="' . $decode['mail_port'] . '"', 'MAIL_PORT="' . $mail_port . '"', $env);
            $env = str_replace('MAIL_USERNAME="' . $decode['mail_username'] . '"', 'MAIL_USERNAME="' . $mail_username . '"', $env);
            $env = str_replace('MAIL_PASSWORD="' . $decode['mail_password'] . '"', 'MAIL_PASSWORD="' . $mail_password . '"', $env);
            $env = str_replace('MAIL_ENCRYPTION="' . $decode['mail_encryption'] . '"', 'MAIL_ENCRYPTION="' . $mail_encryption . '"', $env);
            $env = str_replace('MAIL_FROM_ADDRESS="' . $decode['mail_from_address'] . '"', 'MAIL_FROM_ADDRESS="' . $mail_from_address . '"', $env);
            $env = str_replace('MAIL_FROM_NAME="' . $decode['mail_from_name'] . '"', 'MAIL_FROM_NAME="' . $mail_from_name . '"', $env);
            file_put_contents(base_path('.env'), $env);
            $config->konfigurasi_mail = json_encode($data);
            $config->save();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'SMTP berhasil diubah',
                'refresh' => false,
            ]);
        }
    }
    public function generate()
    {
        $config = Config::first();
        if ($config) {
            $decode = json_decode($config->version_source, true);
            $data = [
                'client_id' => random(10),
                'version' => $decode['version'],
                'last_update' => $decode['last_update'],
                'message' => $decode['message'],
            ];
            $config->version_source = json_encode($data);
            $config->save();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'Berhasil generate client id',
                'refresh' => false,
            ]);
        }
    }
    public function saveTOS($tos)
    {
        $config = Config::first();
        if ($config) {
            $config->tos = $tos;
            $config->save();
            $this->dispatch('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil',
                'text' => 'TOS berhasil diubah',
                'refresh' => false,
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'type' => 'error',
                'title' => 'Gagal',
                'text' => 'Konfigurasi tidak ditemukan',
                'refresh' => false,
            ]);
        }
    }
    public function render()
    {
        $config = Config::first();
        if ($config) {
            if ($this->theme == null) {
                $this->theme = $config->theme_mode;
            }
            if ($this->default_color == null) {
                $this->default_color = $config->color_default;
            }
        }
        return view('livewire.admin.konfigurasi.website', compact('config'));
    }
}
