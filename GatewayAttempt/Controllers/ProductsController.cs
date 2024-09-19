using Microsoft.AspNetCore.Mvc;
using System.Net.Http;
using System.Net.Http.Headers;
using System.Threading.Tasks;

namespace gateway.Controllers
{
    [Route("api/products")]
    [ApiController]
    public class ProductsController : ControllerBase
    {
        private readonly HttpClient _httpClient;

        public ProductsController(HttpClient httpClient)
        {
            _httpClient = httpClient;
        }

        // Obtener todos los productos
        [HttpGet]
        public async Task<IActionResult> GetProducts([FromHeader(Name = "Authorization")] string authorizationHeader)
        {
            // Extraer el token del encabezado Authorization
            if (string.IsNullOrWhiteSpace(authorizationHeader) || !authorizationHeader.StartsWith("Bearer "))
            {
                return Unauthorized("Token no proporcionado o formato incorrecto.");
            }

            var token = authorizationHeader.Substring("Bearer ".Length).Trim();

            // Añadir el token Bearer al encabezado
            _httpClient.DefaultRequestHeaders.Clear();
            _httpClient.DefaultRequestHeaders.Authorization = new AuthenticationHeaderValue("Bearer", token);

            var response = await _httpClient.GetAsync("http://localhost/api/index.php/products");
            var content = await response.Content.ReadAsStringAsync();

            if (response.IsSuccessStatusCode)
            {
                return Content(content, response.Content.Headers.ContentType.ToString());
            }
            else
            {
                return StatusCode((int)response.StatusCode, content);
            }
        }

        // Obtener un producto por ID
        [HttpGet("{id}")]
        public async Task<IActionResult> GetProductById(int id, [FromHeader(Name = "Authorization")] string authorizationHeader)
        {
            // Extraer el token del encabezado Authorization
            if (string.IsNullOrWhiteSpace(authorizationHeader) || !authorizationHeader.StartsWith("Bearer "))
            {
                return Unauthorized("Token no proporcionado o formato incorrecto.");
            }

            var token = authorizationHeader.Substring("Bearer ".Length).Trim();

            // Añadir el token Bearer al encabezado
            _httpClient.DefaultRequestHeaders.Clear();
            _httpClient.DefaultRequestHeaders.Authorization = new AuthenticationHeaderValue("Bearer", token);

            var response = await _httpClient.GetAsync($"http://localhost/api/index.php/products/{id}");
            var content = await response.Content.ReadAsStringAsync();

            if (response.IsSuccessStatusCode)
            {
                return Content(content, response.Content.Headers.ContentType.ToString());
            }
            else
            {
                return StatusCode((int)response.StatusCode, content);
            }
        }

        // Crear un nuevo producto
        [HttpPost]
        public async Task<IActionResult> CreateProduct([FromBody] object product, [FromHeader(Name = "Authorization")] string authorizationHeader)
        {
            // Extraer el token del encabezado Authorization
            if (string.IsNullOrWhiteSpace(authorizationHeader) || !authorizationHeader.StartsWith("Bearer "))
            {
                return Unauthorized("Token no proporcionado o formato incorrecto.");
            }

            var token = authorizationHeader.Substring("Bearer ".Length).Trim();

            // Añadir el token Bearer al encabezado
            _httpClient.DefaultRequestHeaders.Clear();
            _httpClient.DefaultRequestHeaders.Authorization = new AuthenticationHeaderValue("Bearer", token);

            var content = new StringContent(product.ToString(), System.Text.Encoding.UTF8, "application/json");
            var response = await _httpClient.PostAsync("http://localhost/api/index.php/products", content);
            var result = await response.Content.ReadAsStringAsync();

            if (response.IsSuccessStatusCode)
            {
                return Content(result, response.Content.Headers.ContentType.ToString());
            }
            else
            {
                return StatusCode((int)response.StatusCode, result);
            }
        }

        // Actualizar un producto por ID
        [HttpPut("{id}")]
        public async Task<IActionResult> UpdateProduct(int id, [FromBody] object product, [FromHeader(Name = "Authorization")] string authorizationHeader)
        {
            // Extraer el token del encabezado Authorization
            if (string.IsNullOrWhiteSpace(authorizationHeader) || !authorizationHeader.StartsWith("Bearer "))
            {
                return Unauthorized("Token no proporcionado o formato incorrecto.");
            }

            var token = authorizationHeader.Substring("Bearer ".Length).Trim();

            // Añadir el token Bearer al encabezado
            _httpClient.DefaultRequestHeaders.Clear();
            _httpClient.DefaultRequestHeaders.Authorization = new AuthenticationHeaderValue("Bearer", token);

            var content = new StringContent(product.ToString(), System.Text.Encoding.UTF8, "application/json");
            var response = await _httpClient.PutAsync($"http://localhost/api/index.php/products/{id}", content);
            var result = await response.Content.ReadAsStringAsync();

            if (response.IsSuccessStatusCode)
            {
                return Content(result, response.Content.Headers.ContentType.ToString());
            }
            else
            {
                return StatusCode((int)response.StatusCode, result);
            }
        }

        // Eliminar un producto por ID
        [HttpDelete("{id}")]
        public async Task<IActionResult> DeleteProduct(int id, [FromHeader(Name = "Authorization")] string authorizationHeader)
        {
            // Extraer el token del encabezado Authorization
            if (string.IsNullOrWhiteSpace(authorizationHeader) || !authorizationHeader.StartsWith("Bearer "))
            {
                return Unauthorized("Token no proporcionado o formato incorrecto.");
            }

            var token = authorizationHeader.Substring("Bearer ".Length).Trim();

            // Añadir el token Bearer al encabezado
            _httpClient.DefaultRequestHeaders.Clear();
            _httpClient.DefaultRequestHeaders.Authorization = new AuthenticationHeaderValue("Bearer", token);

            var response = await _httpClient.DeleteAsync($"http://localhost/api/index.php/products/{id}");
            var content = await response.Content.ReadAsStringAsync();

            if (response.IsSuccessStatusCode)
            {
                return Content(content, response.Content.Headers.ContentType.ToString());
            }
            else
            {
                return StatusCode((int)response.StatusCode, content);
            }
        }
    }
}
