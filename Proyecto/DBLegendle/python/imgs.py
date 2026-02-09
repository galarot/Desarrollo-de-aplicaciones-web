import os
from PIL import Image

def procesar_mismo_directorio(directorio):
    extensiones_validas = ['.webp', '.web']
    conteo_personajes = {}

    print(f"Limpieza nombre comenzada")

    archivos = [f for f in os.listdir(directorio) if os.path.splitext(f)[1].lower() in extensiones_validas]

    for archivo in archivos:
        nombre_completo, extension = os.path.splitext(archivo)
        
        # --- NUEVA LÓGICA DE LIMPIEZA ---
        # 1. Separamos por guion bajo: ['BChaIco', '0005', 'Krillin', '01']
        partes = nombre_completo.split('_')
        
        # 2. Si tiene varias partes, el nombre suele ser la tercera (índice 2)
        # Si no tiene ese formato, usamos el nombre completo por seguridad
        if len(partes) >= 3:
            nombre_personaje = partes[2].lower().strip()
        else:
            nombre_personaje = nombre_completo.lower().strip()
        
        # 3. Limpiar cualquier número o símbolo que haya quedado en esa parte específica
        nombre_base = "".join(filter(str.isalpha, nombre_personaje))
        
        # 4. Forzar el sufijo 'ex'
        identificador_ex = f"{nombre_base}ex"
        
        # 5. Lógica de numeración para duplicados
        if identificador_ex not in conteo_personajes:
            conteo_personajes[identificador_ex] = 1
            nombre_final = identificador_ex
        else:
            conteo_personajes[identificador_ex] += 1
            nombre_final = f"{identificador_ex}{conteo_personajes[identificador_ex]}"

        ruta_entrada = os.path.join(directorio, archivo)
        ruta_salida = os.path.join(directorio, f"{nombre_final}.png")

        try:
            with Image.open(ruta_entrada) as img:
                img.convert("RGBA").save(ruta_salida, "PNG")
            
            os.remove(ruta_entrada)
            print(f"Furula: {archivo} -> {nombre_final}.png")
            
        except Exception as e:
            print(f"No furula {archivo}: {e}")

    print(f"\nFIN")

# --- RUTA ---
ruta_arts = r""
procesar_mismo_directorio(ruta_arts)