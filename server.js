const http = require('http');
const { spawn } = require('child_process');
const path = require('path');

const PORT = process.env.PORT || 3000;

// Start PHP built-in server
const php = spawn('php', ['-S', `127.0.0.1:8000`, '-t', path.join(__dirname, 'public')], {
  cwd: __dirname,
  stdio: 'inherit'
});

// Create Node proxy server
const server = http.createServer((req, res) => {
  const options = {
    hostname: '127.0.0.1',
    port: 8000,
    path: req.url,
    method: req.method,
    headers: req.headers
  };

  const proxyReq = http.request(options, (proxyRes) => {
    res.writeHead(proxyRes.statusCode, proxyRes.headers);
    proxyRes.pipe(res);
  });

  req.pipe(proxyReq);
});

server.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});

process.on('exit', () => {
  php.kill();
});
