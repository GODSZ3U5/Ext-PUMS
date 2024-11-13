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

        // Método GET para consultar casos
        [HttpGet("consultar-casos")]
        public IActionResult ConsultarCasos()
        {
            try
            {
                // Trama de consulta de casos
                string tramaConsulta = "{\"codigo_servicio\":\"WSSD06\",\"usuario\":2641}";

                // Envío de la trama y recepción de la respuesta
                string response = _socketService.EnviarTramaPorSocket(tramaConsulta);

                return Ok(response);
            }
            catch (Exception ex)
            {
                return StatusCode(500, $"Error al consultar casos: {ex.Message}");
            }
        }

        // Método POST para crear un caso
        [HttpPost("crear-caso")]
        public IActionResult CrearCaso([FromBody] CasoDto caso)
        {
            try
            {
                // Trama de creación de caso
                string tramaCrearCaso = $"{{\"codigo_servicio\":\"WSSD03\",\"usuario\":616,\"fecha_programada\":,\"descripcion\":}}";

                // Envío de la trama y recepción de la respuesta
                string response = _socketService.EnviarTramaPorSocket(tramaCrearCaso);

                return Ok(new { mensaje = "Trama enviada correctamente", respuesta = response });
            }
            catch (Exception ex)
            {
                return StatusCode(500, $"Error al crear caso: {ex.Message}");
            }
        }

        // Método POST de prueba para crear un caso
        [HttpPost("probar-creacion-caso")]
        public IActionResult ProbarCrearCaso([FromBody] PruebaCasoDto pruebaCaso)
        {
            try
            {
                // Trama de prueba para crear un caso
                string tramaPrueba = $"{{\"codigo_servicio\":\"WSSD03\",\"usuario\":2641,\"descripcion\":}}";

                // Envío de la trama de prueba y recepción de la respuesta
                string response = _socketService.EnviarTramaPorSocket(tramaPrueba);

                return Ok(new { mensaje = "Trama de prueba enviada correctamente", respuesta = response });
            }
            catch (Exception ex)
            {
                return StatusCode(500, $"Error al enviar trama de prueba: {ex.Message}");
            }
        }
    }

    // DTO para los datos de entrada del caso
    public class CasoDto
    {
        public string Fecha { get; set; } = string.Empty;
        public string Descripcion { get; set; } = string.Empty;
    }

    // DTO para los datos de entrada en el método de prueba
    public class PruebaCasoDto
    {
        public string Descripcion { get; set; } = string.Empty;
    }
}
