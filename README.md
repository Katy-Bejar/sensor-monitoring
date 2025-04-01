# Sensor Monitoring System

Aplicación web para visualizar datos de temperatura y humedad con Laravel y Chart.js.

## Características principales

- Gráficas combinadas y separadas
- 100 registros de ejemplo
- Diseño responsive

## Instalación

```bash
git clone https://github.com/tu-usuario/sensor-monitoring.git
cd sensor-monitoring
composer install
cp .env.example .env
php artisan key:generate
```

Configura tu base de datos en el archivo `.env` y luego:

```bash
php artisan migrate
php artisan db:seed --class=SensorDataSeeder
php artisan serve
```

Accede a la aplicación en: http://localhost:8000
