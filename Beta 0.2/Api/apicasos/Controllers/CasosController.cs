using Microsoft.AspNetCore.Mvc;
using MiAplicacion.Services; // Importar el espacio de nombres para acceder a SocketService
using System;

namespace MiAplicacion.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class CasosController : ControllerBase
    {
        private readonly SocketService _socketService;

        // Inyección del servicio de sockets
        public CasosController(SocketService socketService)
        {
            _socketService = socketService;
        }
        // Método POST para crear un caso
        [HttpPost("crear-caso")]
public IActionResult CrearCaso([FromBody] CasoDto caso)
{
    try
    {
        // Log: Datos recibidos
        Console.WriteLine($"Datos recibidos: Usuario={caso.usuario}, Descripción={caso.descripcion}, Fecha={caso.fecha}");

        // Validar fecha y descripción
        if (string.IsNullOrEmpty(caso.fecha) || string.IsNullOrEmpty(caso.descripcion))
        {
            Console.WriteLine("Error: La fecha o la descripción están vacías.");
            return BadRequest("La fecha y la descripción son obligatorias.");
        }

        // Convertir la fecha a DateTime
        DateTime fechaProgramada;
        if (!DateTime.TryParse(caso.fecha, out fechaProgramada))
        {
            Console.WriteLine("Error: La fecha proporcionada no tiene un formato válido.");
            return BadRequest("La fecha proporcionada no tiene un formato válido.");
        }

        // Log: Fecha convertida
        Console.WriteLine($"Fecha convertida correctamente: {fechaProgramada:yyyy-MM-dd}");

        // Crear la trama para el socket
        string tramaCrearCaso = $"{{\"codigo_servicio\":\"WSSD09\",\"usuario\":{caso.usuario},\"descripcion\":\"{caso.descripcion}\",\"fecha_programada\":\"{fechaProgramada:yyyy-MM-dd}\"}}";

        // Log: Trama a enviar
        Console.WriteLine($"Trama a enviar: {tramaCrearCaso}");

        // Enviar la trama al socket
        string response = _socketService.EnviarTramaPorSocket(tramaCrearCaso);

        // Log: Respuesta del socket
        Console.WriteLine($"Respuesta del socket: {response}");

        return Ok(new { mensaje = "Trama enviada correctamente", respuesta = response });
    }
    catch (Exception ex)
    {
        Console.WriteLine($"Error en el servidor: {ex.Message}");
        return StatusCode(500, $"Error al crear caso: {ex.Message}");
    }
}
    // DTO para los datos de entrada del caso
    public class CasoDto
    {
        public string usuario {get; set;} = string.Empty;
        public string descripcion { get; set; } = string.Empty;
        public string fecha { get; set; } = string.Empty;   // Fecha en formato string (yyyy-MM-dd)
        
    }
    }}