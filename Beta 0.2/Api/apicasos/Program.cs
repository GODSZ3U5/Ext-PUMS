using Microsoft.AspNetCore.Builder;
using Microsoft.Extensions.DependencyInjection;
using Microsoft.Extensions.Hosting;
using MiAplicacion.Services; // Importar el servicio para los sockets

var builder = WebApplication.CreateBuilder(args);

// Agregar servicios para controladores
builder.Services.AddControllers();

// Configurar el servicio del socket con el servidor y puerto especificados
builder.Services.AddSingleton(new SocketService("172.17.1.7", 13015)); 

// Configurar CORS
builder.Services.AddCors(options =>
{
    options.AddPolicy("AllowSpecificOrigin",
        policyBuilder =>
        {
            policyBuilder.WithOrigins("http://localhost:8080") // Cambia este valor por el origen de tu frontend
                         .AllowAnyHeader()
                         .AllowAnyMethod();
        });
});

// Configurar Swagger
builder.Services.AddEndpointsApiExplorer();
builder.Services.AddSwaggerGen();

var app = builder.Build();

// Habilitar Swagger solo en desarrollo
if (app.Environment.IsDevelopment())
{
    app.UseSwagger();
    app.UseSwaggerUI(c =>
    {
        c.SwaggerEndpoint("/swagger/v1/swagger.json", "API de Casos v1");
        c.RoutePrefix = string.Empty; // Para usar Swagger en la raíz
    });
}

// Habilitar HTTPS Redirection y CORS
app.UseHttpsRedirection();
app.UseCors("AllowSpecificOrigin");

// Habilitar autorización y controladores
app.UseAuthorization();
app.MapControllers();

app.Run();

