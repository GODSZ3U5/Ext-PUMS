using System.Net.Sockets;
using System.Text;

namespace MiAplicacion.Services
{
    public class SocketService
    {
        private readonly string _server;
        private readonly int _port;

        public SocketService(string server, int port)
        {
            _server = server;
            _port = port;
        }

        public string EnviarTramaPorSocket(string trama)
        {
            using (TcpClient client = new TcpClient(_server, _port))
            {
                NetworkStream stream = client.GetStream();
                byte[] data = Encoding.UTF8.GetBytes(trama);
                stream.Write(data, 0, data.Length);

                byte[] buffer = new byte[1024];
                int bytes = stream.Read(buffer, 0, buffer.Length);
                return Encoding.UTF8.GetString(buffer, 0, bytes);
            }
        }
    }
}
