## How to install

- Install project:
```sh
git-clone https://github.com/BohdanPetrenko/utorrentManager.git  
```
- Add env to project <code>cp .env.example .env</code>
- Set the application key <code>php artisan key:generate</code>
- Run <code>composer install</code>
- Build container <code>make build</code>
- Run container <code>make up</code>

Default username - 'admin', password - 'admin'

## Change Basic Auth user/password

Go to <code>.env</code> file and set <code>USER_NAME</code> and <code>USER_PASSWORD</code>
- Re-build container <code>make build</code>
