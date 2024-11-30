import sys
import requests
from bs4 import BeautifulSoup
from google.cloud import language_v1
import json
import re

def obtener_contenido_url(url):
    response = requests.get(url)
    if response.status_code == 200:
        soup = BeautifulSoup(response.text, 'lxml')
        texto = soup.get_text(separator=' ', strip=True)
        return texto
    else:
        raise Exception(f"Error al obtener la URL: {response.status_code}")

def filtrar_texto_irrelevante(texto):
    palabras_a_eliminar = ['site', 'javascript', 'script', 'head', 'body', 'footer', 'html', 'meta', 'link', 'title', 'iframe']
    for palabra in palabras_a_eliminar:
        texto = re.sub(r'\b' + re.escape(palabra) + r'\b', '', texto, flags=re.IGNORECASE)
    texto = re.sub(r'\s+', ' ', texto).strip()
    return texto

def analizar_texto_con_google(texto):
    client = language_v1.LanguageServiceClient()
    document = language_v1.Document(content=texto, type_=language_v1.Document.Type.PLAIN_TEXT)
    response = client.analyze_entities(document=document)
    entidades = []
    for entity in response.entities:
        entidades.append({
            'nombre': entity.name,
            'tipo': language_v1.Entity.Type(entity.type_).name,
            'saliencia': entity.salience
        })
    entidades = sorted(entidades, key=lambda x: x['saliencia'], reverse=True)
    return entidades[:5]

def main():
    url = sys.argv[1]  # URL pasada como argumento
    try:
        contenido = obtener_contenido_url(url)
        texto_limpio = filtrar_texto_irrelevante(contenido)
        entidades_relevantes = analizar_texto_con_google(texto_limpio)
        # Devolver el resultado como JSON
        print(json.dumps(entidades_relevantes))
    except Exception as e:
        print(json.dumps({"error": str(e)}))

if __name__ == '__main__':
    main()
